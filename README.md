# iTutor

Aplicación web de gestión escolar (alumnos, grupos, asignaturas, profesores,
horarios, faltas, diario, evaluaciones, comportamiento, pruebas y festivos)
desarrollada sobre **Symfony 1** con **Propel** como ORM y **sfGuardPlugin**
para autenticación.

El proyecto ha sido modernizado para correr sobre **PHP 8.5** (imagen
oficial `php:8.5.12-apache`), reemplazando a la antigua imagen
`nimmis/apache-php5:latest` (PHP 5.5, obsoleta y ya no disponible).

## Requisitos

* Docker y Docker Compose
* Make (opcional, para atajos)

## Arranque

```bash
make up
```

o equivalentemente:

```bash
docker compose up -d
```

Esto arranca:

| Servicio       | Puerto            | Descripción                                          |
| -------------- | ----------------- | ---------------------------------------------------- |
| `web`          | `http://localhost`      | Aplicación (Apache + PHP 8.5, entorno `prod`)        |
| `web` (debug)  | `http://localhost/itutor_dev.php` | Controlador de debug (entorno `dev`)     |
| `phpmyadmin`   | `http://localhost:8080` | phpMyAdmin (usuario `root`, sin contraseña)         |
| `bd`           | `127.0.0.1:3306`    | MariaDB 11 (solo accesible desde la red local)       |

Credenciales de la aplicación: usuario **`admin`** / contraseña
**`12345Abcde`**.

Credenciales de la base de datos (usuario `itutor`): ver `docker-compose.yml`
(`MYSQL_USER` / `MYSQL_PASSWORD`, por defecto `itutor` / `12345Abcde`).

La base de datos se crea y se alimenta automáticamente en el primer arranque
con `config/sql/itutor.sql` (esquema + datos de ejemplo).

## Tests

```bash
make test
```

Ejecuta la batería de pruebas (`tests/`):

1. **Lint**: `php -l` sobre todos los archivos PHP de la aplicación
   (framework, plugins, modelos, acciones, plantillas...).
2. **Batería funcional HTTP** (39 pruebas): accesibilidad y esquema de la BD,
   página de inicio anónima, login válido/inválido, los 13 módulos
   autenticados, subrutas de los módulos generados, generación de PDF,
   controlador de debug, rutas desconocidas,
   logout y verificación de que **ninguna respuesta contiene warnings,
   notices ni errores de PHP**.

La batería corre en un contenedor `php:8.5.12-cli` dentro de la red de
Docker (`make test` = `docker compose --profile tools run --rm tests`).

### Recorrido exhaustivo de rutas

```bash
make sweep
```

Recorre **todas las rutas** de la aplicación (13 módulos + plugins, con
sus parámetros y variantes de fecha) contra el front controller de debug,
login con `admin`, y detecta cualquier `Deprecated`, `Warning`, `Notice`,
`Fatal error` o `Parse error` en cada respuesta. Es la herramienta con la
que se auditó la migración: detecta en un solo pase los errores que la
batería funcional no ejercita. (Solo lectura: no muta datos; para probar
los POST se necesita `ITUTOR_POST=1 make sweep`.)

## Otros targets

```
make up       Arranca los contenedores en segundo plano
make down     Para y elimina los contenedores
make logs     Sigue los logs de la aplicación
make clean    Borra la caché de configuración de Symfony
make test     Ejecuta la batería de pruebas
make sweep    Recorrido exhaustivo de rutas (detecta PHP markers en debug)
make help     Muestra esta ayuda
```

## Notas técnicas de la migración a PHP 8.5

* `config/Dockerfile.web` construye la imagen desde `php:8.5.12-apache` con
  las extensiones necesarias (`mysqli`, `intl`, `gd`, `zip`, `curl`) y un
  `php.ini` propio (`display_errors=Off`, `error_reporting=E_ALL &
  ~E_DEPRECATED`, opcache).
* `app/web/.htaccess` enruta las URL limpias a `index.php` (PATH_INFO),
  patrón estándar de Symfony 1.
* El framework Symfony 1.0.x, Propel, Creole, pake y TCPDF llevan parches
  mínimos para PHP 8: `__autoload`→`spl_autoload_register`, `each`→`foreach`,
  `create_function`→closures, `split`/`ereg`→`preg_*`/`explode`,
  `chr((int))` en TCPDF, propiedades dinámicas declaradas (Spyc, sfI18N),
  `#[\ReturnTypeWillChange]` en decoradores e iteradores, `strftime`→`date`
  y guards `isset` para arrays de idioma de TCPDF.
* `app/config/databases.yml` y `app/config/propel.ini` usan el driver
  `mysqli` con el host `bd` de la red de Compose.
* `Makefile` actualizado y `docker-compose.yml` con healthcheck de la BD
  (`bd` debe estar `healthy` antes de arrancar `web`).
