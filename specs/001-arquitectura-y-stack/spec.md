# SPEC 001 — Arquitectura y stack del proyecto iTutor

> **Estado:** APROBADO
> **Responsable:** equipo iTutor / agentes IA

## 1. Contexto

iTutor es una aplicación web de gestión escolar construida en 2008 sobre
**Symfony 1.0** con **Propel** como ORM y **sfGuardPlugin** para autenticación,
y **TCPDF** (vía sfTCPDFPlugin) para generación de PDF.

Históricamente el runtime era PHP 5.5 (imagen `nimmis/apache-php5`, ya
descontinuada). La migración actual (rama `php_8`, mergeada) ha portado el
framework, Propel, Creole y TCPDF a **PHP 8.5**, usando la imagen oficial
`php:8.5.12-apache`, y ha estandarizado la infraestructura sobre Docker
Compose con **MariaDB 12.3`.

Este spec consolida el **estado actual** de la arquitectura, el stack, el
entorno de despliegue y los criterios de calidad que todo agente de IA debe
conocer antes de proponer o ejecutar cambios.

## 2. Visión

Conservar la arquitectura de monolito modular de Symfony 1, portándola a
runtime moderno (PHP 8.5) y estableciendo una cadena de calidad automatizada
(lint + batería funcional + recorrido de rutas) que garantice un uso limpio de
PHP en todas las respuestas HTTP.

## 3. Alcance

### 3.1 Dentro del alcance

- Stack tecnológico vigente (runtime, framework, ORM, BD, PDF, infraestructura).
- Configuración de los entornos Symfony (`prod`, `dev`, `test`).
- Docker Compose y estrategia de despliegue.
- Estrategia de tests y calidad.
- Parches PHP 8 ya aplicados sobre framework vendoreado y librerías.

### 3.2 Fuera de alcance

- Migración a Symfony 2/4/Laravel u otro stack de persistencia.
- Reescritura del frontend o del backend.
- Cambios de esquema de BD no derivados de `app/config/schema.yml`.

## 4. Requisitos

### 4.1 Requisitos funcionales

- **RF-001**: Arranque reproducible mediante Docker Compose (`web`, `bd`,
  `phpmyadmin`, `tests`).
- **RF-002**: Front controller de producción (`app/web/index.php`) y de debug
  (`app/web/itutor_dev.php`).
- **RF-003**: Autenticación / sesión / recuperación de contraseña mediante
  sfGuard (`/login`, `/logout`, `/request_password`).
- **RF-004**: Generación de PDF mediante sfTCPDF.
- **RF-005**: Suite de calidad automatizada (lint, batería funcional HTTP, sweep
  de rutas).

### 4.2 Requisitos no funcionales

- **NFR-001**: Runtime PHP 8.5 (imágenes oficiales `php:8.5.12-*`).
- **NFR-002**: Cero warnings / notices / deprecations / fatals / parse errors en
  las respuestas HTTP de la aplicación (verificado con `make test` y `make sweep`).
- **NFR-003**: Seguridad por defecto (`is_secure`, `credentials: admin`).
- **NFR-004**: Cache, log y debug desactivados/activados por entorno
  (`prod`, `dev`, `test`).

## 5. Criterios de aceptación

- **AC-001**: `docker compose up -d` arranca el contenedor `bd` en estado
  `healthy` y el contenedor `web`.
- **AC-002**: `make test` ejecuta lint + batería funcional y pasa la batería
  completa.
- **AC-003**: `make sweep` no detecta markers PHP en ninguna respuesta.
- **AC-004**: El front controller de producción (`index.php`) y de debug
  (`itutor_dev.php`) arrancan sin errores bajo PHP 8.5.

## 6. Diseño

Resumen de la arquitectura; ver [`design.md`](./design.md) para decisiones
técnicas completas.

## 7. Tareas

Resumen de las tareas de migración y calidad; ver [`tasks.md`](./tasks.md).

- [x] Reemplazo de la imagen `nimmis/apache-php5` por `php:8.5.12-apache`.
- [x] Portado de Symfony 1 / Propel / Creole / TCPDF a PHP 8.
- [x] Adaptación de configuración Symfony (`propel.ini`, `databases.yml`) a
  mysqli / PHP 8.5.
- [x] Docker Compose con healthcheck de BD y perfil `tools` para tests.
- [x] Batería de tests funcionales y lint.
- [x] Recorrido exhaustivo de rutas (`route_sweep.php`).

- [ ] Migración a otro stack de persistencia / framework.
