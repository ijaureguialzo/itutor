# AGENTS.md — Normas del proyecto iTutor para agentes de IA

> Documento de normas operativas para cualquier agente de IA (o desarrollador
> humano que colabore con ellos) que trabaje en el repositorio de iTutor.
> Complementa y debe leerse junto con la documentación técnica bajo `specs/`.

## 1. Contexto del proyecto

**iTutor** es una aplicación web de **gestión escolar** (alumnos, grupos,
asignaturas, profesores, horarios, horas, perfiles, faltas, diario,
evaluaciones, comportamiento, pruebas y festivos).

- **Stack histórico**: PHP 5.5 + Symfony 1.0 + Propel + sfGuardPlugin + TCPDF.
- **Stack actual**: PHP 8.5 (imágenes oficiales `php:8.5.12-apache` y
  `php:8.5.12-cli`), Symfony 1.0 (vendoreado en `app/lib/vendor/symfony` con
  parches mínimos para PHP 8), Propel, MariaDB 12.3, Docker Compose, sfTCPDFPlugin.

La migración a PHP 8.5 está **completada** (rama `php_8` mergeada): el framework
Symfony 1, Propel, Creole y TCPDF llevan parches mínimos para PHP 8, y el
proyecto arranca sobre la imagen oficial `php:8.5.12-apache`.

## 2. Stack tecnológico

| Capa | Tecnología |
| ---- | ---------- |
| Runtime PHP | 8.5 (`php:8.5.12-apache` en `web`, `php:8.5.12-cli` en `tests`) |
| Framework web | Symfony 1.0.x (vendoreado, `app/lib/vendor/symfony`) |
| ORM | Propel (`app/config/propel.ini`, `app/config/schema.yml`, `app/lib/model`) |
| Autenticación / autorización | sfGuardPlugin (`app/plugins/sfGuardPlugin`) |
| PDF | sfTCPDFPlugin (`app/plugins/sfTCPDFPlugin`, basado en TCPDF) |
| Base de datos | MariaDB 12.3 (contenedor `bd`), driver `mysqli` |
| Infraestructura | Docker Compose (`web`, `bd`, `phpmyadmin`, `tests` con profile `tools`), Traefik (override `docker-compose.traefik.yml`) |
| Tests | Batería propia (no PHPUnit): `tests/itutor_test.php`, `tests/lint.sh`, `tests/route_sweep.php`, `tests/run.sh` |

### 2.1 Parches PHP 8 conocidos (no re-implementar sin spec)

- `__autoload` → `spl_autoload_register`.
- `each()` → `foreach`.
- `create_function()` → closures.
- `split()` / `ereg()` → `preg_*` / `explode`.
- `chr((int)` en TCPDF → `chr((int)`.
- Propiedades dinámicas declaradas (Spyc, sfI18N).
- `#[\ReturnTypeWillChange]` en decoradores e iteradores.
- `strftime` → `date`.
- Guards `isset` para arrays de idioma de TCPDF.

## 3. Comandos y entorno

```bash
make up        # arranca los contenedores en segundo plano
make down      # para y elimina los contenedores
make restart
make build
make logs
make stats
make workspace        # bash dentro del contenedor web
make clean            # docker compose down -v --remove-orphans

make start-traefik   # arranque con Traefik (FQDN itutor.test)

make test             # lint + batería funcional HTTP (docker compose --profile tools run --rm tests)
make sweep            # recorrido exhaustivo de rutas (php tests/route_sweep.php --base=http://localhost --pass=all)
make help
```

Equivalentes directos de Docker Compose:

```bash
docker compose up -d
docker compose --profile tools run --rm tests
docker compose exec web /bin/bash
```

**Flujo obligatorio para validar cualquier cambio:**

1. `make up` (la BD debe estar `healthy` antes de arrancar `web`).
2. `make test` — lint + batería funcional (`tests/run.sh`: `tests/lint.sh` + `tests/itutor_test.php`).
3. `make sweep` — recorrido de rutas y detección de markers PHP.

La batería de tests (`tests/itutor_test.php`) verifica: esquema de BD vía mysqli,
arranque del framework, login válido/inválido, los módulos autenticados, subrutas
generadas, generación de PDF, front controller de debug, rutas desconocidas, logout
y ausencia de warnings/notices/deprecations en las respuestas.

## 4. Estructura del repositorio (puntos clave)

```
.
├── AGENTS.md                     # Este documento: normas para agentes
├── README.md                     # Documentación de usuario/migración
├── Makefile
├── docker-compose.yml / -override.yml / -traefik.yml
├── .env / env-example            # Variables de entorno (PHP_VERSION, MYSQL_*, FQDN_*)
├── specs/                        # Especificaciones SDD (ver specs/README.md)
├── config/                       # Dockerfile.web y sql/itutor.sql (BD inicial)
├── tests/                        # Batería de tests propia
└── app/
    ├── apps/itutor/              # Aplicación Symfony 1 (SF_APP = itutor)
    │   ├── config/               # routing, security, settings, view, factories, filters, cache, logging, i18n, app
    │   ├── i18n/                 # messages.es.xml, messages.eu.xml
    │   ├── lib/                  # myUser (custom user), y librerías
    │   ├── modules/              # Un módulo por dominio (ver §5.1)
    │   └── templates/           # layout.php y componentes transversales
    ├── config/                    # config Symfony (schema.yml, propel.ini, databases.yml, ...)
    ├── data/                     # sql de BD (lib.model.schema.sql, ...)
    ├── fixtures/                 # Fixtures Propel (100_*, 200_*, 300_*, 400_*)
    ├── lib/                      # model/, model_viejo/, vendor/symfony/
    ├── plugins/                  # sfGuardPlugin, sfTCPDFPlugin
    ├── test/                     # Tests legacy de Symfony (bootstrap/functional/unit)
    ├── web/                      # Front controllers (index.php, itutor_dev.php), css/js/images
    ├── cache/ / app/log/
    └── html/
```

## 5. Arquitectura y patrones de código

### 5.1 Módulos Symfony 1

Cada módulo vive en `app/apps/itutor/modules/<module>/`:

- `actions/actions.class.php` — clase `<module>Actions extends sfActions`.
- `actions/components.class.php` — opcional, `<module>Components extends sfComponents`.
- `templates/` — plantillas por acción; **patrón Symfony 1**: la plantilla se
  llama `<action>Success.php` (p. ej. `listSuccess.php`, `showSuccess.php`,
  `editSuccess.php`). Para acciones de error se usa `errorSuccess.php` y para
  warnings `warningSuccess.php`.
- `config/security.yml` — opcional; define `all: is_secure: on` y
  `credentials: admin` para proteger el módulo.

Módulos de aplicación: `principal, alumno, asignatura, profesor, grupo, horario,
hora, perfil, festivo, diario, evaluacion, falta, prueba, comportamiento,
grupoevaluacion, listados, pdf`. Plugins activados: `sfGuardAuth, sfGuardGroup,
sfGuardPermission, sfGuardUser, sfTCPDF`. Legacy: `prueba_viejo`.

### 5.2 Convenciones en acciones

- Métodos públicos `execute<Accion>()` (p. ej. `executeIndex`, `executeList`,
  `executeShow`, `executeCreate`, `executeEdit`, `executeUpdate`,
  `executeDelete`).
- Consultas Propel con `Criteria` y peers estáticos:
  `XxxPeer::doSelect($criteria)`, `XxxPeer::doSelectOne($criteria)`,
  `XxxPeer::retrieveByPk($id)`.
- Recursos inexistentes: `$this->forward404Unless($object);`.
- Redirección: `return $this->redirect('modulo/action?param='.$valor);`.
- Errores de negocio: `return $this->redirect('principal/error?mensaje=' . $mensaje);`
  o asignar `$this->mensaje` en `executeError` / `executeWarning`.
- Warnings con códigos numéricos (p. ej. `error == 1`, `error == 2`) y mensajes en
  `executeWarning` de `principal`.

### 5.3 Plantillas

- Helpers: `<?php use_helper('Date') ?>`, `<?php use_helper('I18N') ?>`,
  `<?php use_helper('Validation', 'I18N') ?>` (cabecera).
- Variables del controlador: se accede como `$this->algo` dentro de la clase de
  acción; en plantillas el contenido se extrae con `$sf_data->getRaw('sf_content')`.
- Usuario: `$sf_user->isAuthenticated()`, `$sf_user->isSuperAdmin()`,
  `$sf_user->getPermissions()`, atributos `$sf_user->getAttribute('codigo')` /
  `'nombre'` / booleanos `'horas'`, `'asignaturas'`, `'horario'`.
- Mensajes: `<?php echo __($mensaje) ?>`.

### 5.4 Internacionalización

- `app/apps/itutor/i18n/messages.es.xml` y `messages.eu.xml`.
- `source-language="es_ES"`, `default_culture: es` (settings), i18n activado.
- Prefijos de no traducción: `[T]` … `[/T]`.
- Claves habituales: `username`, `password`, `sign in`, `filter`, `create`,
  `reset`, `remember me`, etc.

### 5.5 Seguridad

- Los módulos con datos requieren autenticación y rol `admin`
  (`all: is_secure: on` + `credentials: admin` en `config/security.yml`).
- A nivel de aplicación: `enabled_modules`, `secure_module: principal`,
  `secure_action: index`, login module/action `sfGuardAuth/signin`.
- No usar `eval`, no credenciales en código fuente (variables de entorno / .env).

## 6. Reglas de negocio (invariants críticos)

1. **Porcentajes de evaluación**: la suma de los porcentajes de las pruebas de
   una evaluación debe ser 100. Si una prueba tiene porcentaje 100, no pueden
   existir otras pruebas con porcentaje < 100 en la misma evaluación.
   - Error 1: "No puede haber pruebas que tengan como porcentaje 100 y menos de
     100 al mismo tiempo."
   - Error 2: "La suma de los porcentajes de las pruebas debe ser 100."
2. **Porcentajes por defecto** por asignatura: pruebas 80, faltas 10,
   comportamiento 10; `maximofaltas` 10.
3. **Faltas**: registran `dia`, `hora`, `fecha`, `justificado`, `observaciones`;
   control de faltas por alumno/asignatura/evaluación/grupo.
4. **Diario**: actividad docente (`actividad`, `udidactica`) asociada a
   evaluación + asignatura + grupo + profesor + fecha.
5. **Horarios/horas**: tramos (`tramo`, `descanso`) y asociación horario ↔
   perfil (`Horaperfil.orden`).

## 7. Testing y calidad

- **Lint**: `bash tests/lint.sh` (o `php -l <fichero>`): todo PHP de la aplicación
  debe parsear bajo PHP 8.x. Excluye `cache/*`, `log/*` y skeletons de
  generadores con placeholders `##PLACEHOLDER##`.
- **Batería funcional**: `make test` → `tests/run.sh` → `tests/itutor_test.php`
  (HTTP contra el contenedor `web`).
- **Recorrido de rutas**: `make sweep` → `tests/route_sweep.php`; detecta
  `Deprecated|Warning|Notice|Fatal error|Parse error` en cada respuesta.
- **Política**: ninguna respuesta del frontend debe contener markers de error
  PHP. Tras cualquier cambio en acciones/plantillas: `make test` y `make sweep`.

## 8. Seguridad y datos

- `.env` (no versionado) y `env-example` para variables; contraseñas no en código.
- Settings: `prod` (cache on, no_script_name off, etag off), `dev` (cache off,
  web_debug on, error_reporting 32767), `test` (error_reporting 8191 =
  E_ALL minus deprecations).
- `error_reporting = E_ALL & ~E_DEPRECATED` en runtime web (Docker);
  `display_errors = Off`.

## 9. Prohibiciones y cuidados

- No refactorizar el framework vendoreado salvo con spec y parches justificados.
- No tocar código generado (`app/lib/model/om`, `map`, `app/config/generated-*`,
  `sfGuardPlugin/lib/model` generado) salvo regeneración planificada.
- No eliminar funcionalidades legacy (`prueba_viejo`) sin spec.
- No introducir APIs obsoletas (`each`, `create_function`, `split`, `ereg`,
  `mysql_*`, `strftime`) — el lint y el sweep los penalizan.
- No mezclar idiomas: comentarios y mensajes en español, identificadores en
  inglés/PascalCase.

## 10. Flujo SDD para agentes

1. Leer este `AGENTS.md`.
2. Leer el spec aplicable en `specs/` (índice en `specs/README.md`).
3. Seguir el ciclo SDD: `spec.md` → `design.md` → `tasks.md` → implementar →
   testear → revisar.
4. Actualizar `tasks.md` al cerrar cada tarea.
5. No implementar fuera de un spec aprobado salvo petición explícita del
   usuario.

## 11. Commits

- Los cambios del repositorio se commitean siguiendo **Conventional Commits**.
- Formato: `type(scope): subject` (p. ej. `docs(spec): ...`, `feat(modulo): ...`,
  `fix(app): ...`).
- Cada commit debe incluir el **trailer de co-autoría del agente** con el
  identificador del modelo con el que se trabaja:
  `Co-authored-by: <modelo> <email>`.
- Ejemplo:

  ```
  docs(spec): añadir especificaciones SDD para agentes IA

  Co-authored-by: unsloth/flint-GGUF:UD-Q4_K_XL <flint@lmstudio.local>
  ```
