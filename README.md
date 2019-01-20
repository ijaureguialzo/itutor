# iTutor

Aplicación de gestión de alumnos.

## Instalación

1. Instalar [Docker](https://www.docker.com/get-started).
2. Clonar este repositorio.
3. Arrancar la aplicación con `docker-compose up -d`

## Aplicación

- Acceder a [localhost](http://localhost/).
- Iniciar sesión con `admin/12345Abcde`

## Utilidades

- Controlador de depuracion en [itutor_dev](http://localhost/itutor_dev.php).
- Acceso mediante shell: `docker-compose exec web /bin/bash`
- Contenedor con [phpMyAdmin](http://localhost:8080/).
- Analizador de logs de Apache con [GoAccess](http://localhost/goaccess/).
