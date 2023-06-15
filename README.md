# iTutor

Aplicación de gestión de alumnos.

## Prerrequisitos

1. Instalar Docker Desktop para [Windows y macOS](https://www.docker.com/products/docker-desktop/)
   o [Linux](https://docs.docker.com/desktop/linux/install/).

2. En Windows, instalar [Scoop](https://scoop.sh) usando PowerShell:

   ```powershell
   Set-ExecutionPolicy RemoteSigned -Scope CurrentUser
   [Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls12
   Invoke-Expression (New-Object System.Net.WebClient).DownloadString('https://get.scoop.sh')
   ```

   Y después instalar los comandos necesarios:

   ```powershell
   scoop install make
   ```

3. Clonar este repositorio:

   ```shell
   git clone https://github.com/ijaureguialzo/itutor.git
   ```

   > Si el comando anterior no funciona, habrá que [instalar Git](https://git-scm.com/downloads) en el sistema.

## Arrancar el servidor

1. En un terminal, situarse en la carpeta `itutor` (o si se ha renombrado, la que contenga este archivo `README.md`):

   ```shell
   cd itutor
   ```

2. Arrancar los servicios:

   ```shell
   make start
   ```

## Acceso a la aplicación

- Acceder a [localhost](http://localhost/).
- Iniciar sesión con `admin/12345Abcde`

## Utilidades

- Controlador de depuracion en [itutor_dev](http://localhost/itutor_dev.php).
- Acceso mediante shell: `make workspace`
- Contenedor con [phpMyAdmin](http://localhost:8080/).
