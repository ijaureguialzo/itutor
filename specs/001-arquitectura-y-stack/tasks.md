# TASKS — SPEC 001: Arquitectura y stack del proyecto iTutor

## Migración a PHP 8.5 (completada)

- [x] Reemplazar imagen `nimmis/apache-php5` por `php:8.5.12-apache`
      (`config/Dockerfile.web`, `docker-compose.yml`).
- [x] Portar Symfony 1 / Propel / Creole / TCPDF a PHP 8
      (`__autoload`, `each`, `create_function`, `split`/`ereg`, `chr((int)`,
      propiedades dinámicas, `#[ReturnTypeWillChange]`, `strftime`, guards).
- [x] Adaptar configuración Symfony a mysqli + PHP 8.5 (`propel.ini`,
      `app/config/databases.yml`).
- [x] Ajustar settings por entorno (`prod`, `dev`, `test`).
- [x] Ajustar `php.ini` (Docker) y Apache (`AllowOverride All`,
      `DirectoryIndex index.php itutor_dev.php`).

## Infraestructura Docker (completada)

- [x] Servicios compose: `bd` (MariaDB 12.3 + healthcheck + init SQL),
      `web`, `phpmyadmin`, `tests` (profile `tools`).
- [x] Override Traefik (FQDN `itutor.test`, `phpmyadmin.itutor.test`).

## Calidad (completada)

- [x] `tests/lint.sh` — lint PHP 8 sobre la app.
- [x] `tests/itutor_test.php` — batería funcional HTTP (39 checks).
- [x] `tests/route_sweep.php` — recorrido exhaustivo de rutas.
- [x] `tests/run.sh` — orquestador lint + batería.
- [x] `make test` y `make sweep` operativos.

## Pendientes

- [ ] Evaluar migración a otro framework / ORM (fuera de alcance actual).
- [ ] Evaluar upgrade de versiones fijas de imágenes.
