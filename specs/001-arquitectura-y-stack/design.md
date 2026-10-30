# DESIGN — SPEC 001: Arquitectura y stack del proyecto iTutor

## 1. Contexto

Aplicación legacy Symfony 1 + Propel + sfGuard + TCPDF en PHP 5.5, migrada a
PHP 8.5 con Docker Compose y MariaDB.

## 2. Decisiones

### D-1: Mantener Symfony 1.x y Propel
- **Decisión**: conservar el framework y el ORM actuales.
- **Justificación**: coste de migración alto; el dominio ya funciona; el foco
  actual es estabilidad en PHP 8.5 y calidad.
- **Consecuencia**: cualquier cambio debe respetar el estilo Symfony 1 (módulos,
  actions, templates, Criteria/Peers).

### D-2: Runtime PHP 8.5
- **Decisión**: imagen base `php:8.5.12-apache` (web) y `php:8.5.12-cli` (tests).
- **Justificación**: imagen oficial soportada y disponible.
- **Parches**: mínimos y localizados en framework vendoreado, Propel, Creole y
  TCPDF (ver AGENTS.md §2.1).

### D-3: MariaDB 12.3
- **Decisión**: base de datos MariaDB 12.3.
- **Justificación**: drop-in frente a MySQL para Propel/mysqli.

### D-4: Docker Compose como único flujo de despliegue
- **Decisión**: servicios `web`, `bd`, `phpmyadmin`; override Traefik para
  FQDNs; profile `tools` para tests.
- **Justificación**: reproducibilidad.

### D-5: Cadena de calidad propia (no PHPUnit de Symfony 1)
- **Decisión**: lint (`php -l`), batería HTTP funcional (`tests/itutor_test.php`),
  sweep (`tests/route_sweep.php`).
- **Justificación**: el framework Symfony 1 no incluye runner usable en este
  entorno; la batería custom ya está operativa.

## 3. Arquitectura de componentes

```
Docker Compose
├── bd        (mariadb:12.3, healthcheck, init: ./config/sql/itutor.sql)
├── web       (php:8.5.12-apache, Dockerfile: config/Dockerfile.web)
├── phpmyadmin
└── tests    (php:8.5.12-cli, profile tools) → lint.sh + itutor_test.php + route_sweep.php

web (Apache + PHP 8.5)
├── app/web/index.php            (SF_ENVIRONMENT=prod, SF_DEBUG=false)
├── app/web/itutor_dev.php       (SF_ENVIRONMENT=dev, SF_DEBUG=true)
└── app/apps/itutor/             (SF_APP=itutor)
    ├── config/                   (routing, security, settings, view, factories, filters, cache, logging, i18n, app)
    ├── modules/                  (17 módulos de negocio + plugins)
    └── templates/layout.php

Datos
├── app/config/schema.yml         (Propel schema)
├── app/lib/model/ (+ model_viejo/)
├── app/data/sql/                 (esquema SQL)
├── app/fixtures/                 (fixtures Propel)
└── app/generar_bd                (script: symfony propel-build-all-load itutor)

Calidad
├── tests/lint.sh
├── tests/itutor_test.php
├── tests/route_sweep.php
└── tests/run.sh
```

## 4. Configuración de Symfony por entorno

- `prod`: cache on, no_script_name off, etag off, error_reporting 32767? (no:
  prod settings: cache on; dev: error_reporting 32767, web_debug on, cache off;
  test: error_reporting 8191 = E_ALL & ~E_DEPRECATED, cache off).
- Runtime web (Docker): `error_reporting = E_ALL & ~E_DEPRECATED`, `display_errors = Off`, `log_errors On`.

## 5. Tuning PHP (Docker)

- memory_limit 256M, post_max_size 32M, upload_max_filesize 16M,
  max_execution_time 120, expose_php Off, opcache habilitado.

## 6. Alternativas consideradas

- **Doctrine/DBAL**: descartado (cambio mayor de stack).
- **Symfony 4+**: descartado (reescritura).
- **MySQL en vez de MariaDB**: descartado (drop-in, se prefirió MariaDB por
  disponibilidad del tag).

## 7. Riesgos

- Framework legacy: deuda técnica inevitable.
- Dependencias de versiones fijas (`php:8.5.12-apache` con ARG configurable).

## 8. Mitigaciones

- Tests + sweep como red de seguridad.
- Parches mínimos y documentados.
