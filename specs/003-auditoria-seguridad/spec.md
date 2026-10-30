# SPEC 003 — Auditoría de seguridad del proyecto iTutor

> **Estado:** APROBADO (auditoría inicial)
> **Responsable:** equipo iTutor / agentes IA

## 1. Contexto

iTutor es una aplicación web de gestión escolar (Symfony 1 + Propel + sfGuard,
PHP 8.5, Docker, Traefik con SSL en producción). La auditoría de seguridad se
realiza sobre el código fuente, la configuración de Symfony, los front
controllers, las plantillas y los flujos de autenticación/autorización.

## 2. Objetivo

Detectar vulnerabilidades de seguridad y emitir una **lista priorizada de
problemas** que deben corregirse para evitar ataques (OWASP Top 10 aplicado al
contexto del proyecto).

## 3. Alcance

### 3.1 Dentro del alcance
- Autenticación / autorización (sfGuard, security.yml, módulos).
- CSRF en formularios y endpoints POST.
- XSS (plantillas, mensajes de error, datos).
- Acceso al front controller de debug.
- Sesión / cookies / HTTPS.
- Validación de entradas y manejo de uploads.
- Exposición de información / manejo de errores.

### 3.2 Fuera de alcance
- Auditoría de infraestructura (Docker, Traefik, MariaDB) — se asume base hardened.
- Revisión de componentes de terceros no usados.

## 4. Metodología

Revisión estática de:
- `app/apps/itutor/config/*` (settings, security, routing, view).
- `app/web/index.php` y `app/web/itutor_dev.php`.
- `app/apps/itutor/modules/**/actions` y `templates`.
- `app/plugins/sfGuardPlugin` (auth).
- `app/config/schema.yml`, `databases.yml`.

## 5. Hallazgos

### 5.1 Críticos — P0

- **H1 — XSS por falta de escaping en plantillas (`HIGH` impacto).**
  - Evidencia: `settings.yml` define `escaping_strategy: bc`; `sfPHPView` solo
    expone variables crudas para estrategia `bc`, y el código de plantillas no
    usa el helper `escape()`/`e()` en ningún template de módulo. Se usan
    expresiones como `<?php echo $var ?>` sin escape.
  - Vector reflejado: `GET /<modulo>/error?mensaje=<script>...` (mensajes leídos
    en `executeError`/`executeWarning` desde `getRequestParameter('mensaje')`).
  - Vector almacenado: campos de BD (observaciones, notas, nombres) renderizados
    en listados sin escapar.
  - Acción: usar `escape()` en todas las salidas o cambiar a `escaping_strategy: on`.

- **H2 — Front controller de debug accesible públicamente (`CRITICAL`).**
  - Evidencia: `app/web/itutor_dev.php` contiene el guard `REMOTE_ADDR` pero con
    el `die()` **comentado**. Con `SF_DEBUG=true` expone toolbar, errores detallados.

### 5.2 Altos — P1

- **H3 — Protección CSRF ausente en endpoints POST (`HIGH`).**
  - Evidencia: `FormHelper::form_tag` del vendoreado no genera token; las acciones
    (p. ej. `executeUpdate`) no validan `form_token` ni usan `sfForm` con token.

- **H4 — Sin rate limiting / brute force en login (`MEDIUM`).**
  - Evidencia: `BasesfGuardAuthActions` no implementa throttling.

- **H5 — HTTPS no forzado / cookie de sesión sin flags de seguridad (`MEDIUM`).**
  - Contexto: Traefik termina SSL en producción; la app no fuerza HTTPS ni marca
    cookie de sesión `Secure`/`HttpOnly`.

### 5.3 Medios — P2

- **H6 — Cobertura de seguridad por módulo irregular.**
  - Solo `profesor`, `perfil`, `evaluacion`, `hora`, `grupo` declaran
    `credentials: admin`; el resto depende del default; conviene auditar módulo por módulo.

- **H7 — Validación de inputs / uploads (`MEDIUM`).**
  - Uso directo de `$_FILES` en acciones de alumno (`foto`), `mkdir` de directorios.

### 5.4 Bajos — P3

- **H8 — Sesión con timeout por defecto y sin flags explícitos.**

## 6. Lista priorizada de problemas para evitar ataques

| ID | Severidad | Problema | Evidencia | Riesgo | Acción sugerida |
|----|-----------|---------|-----------|--------|-----------------|
| H1 | P0 | XSS por falta de escaping / mensajes reflejados sin escape | templates sin `escape()`, `mensaje` desde request | Alta | Escaping obligatorio en plantillas + mensajes internos |
| H2 | P0 | Debug front controller público | `die()` comentado en `itutor_dev.php` | Alta | Restaurar guard / restringir por entorno |
| H3 | P1 | CSRF ausente en POST | `form_tag` sin token + acciones sin validación | Alta | Token CSRF en formularios/actions |
| H4 | P1 | Sin rate limit/brute force | `BasesfGuardAuthActions` | Media | Throttle en login |
| H5 | P1 | HTTPS no forzado / cookie sin Secure | settings Traefik SSL | Media | HSTS, redirect HTTPS, cookie Secure |
| H6 | P2 | Cobertura security por módulo irregular | 5 módulos con credentials | Media | Auditar y completar |
| H7 | P2 | Inputs/uploads | `$_FILES`, `mkdir` | Media | Allowlist tipo/tamaño |
| H8 | P3 | Sesión/cookies | settings default | Baja | Flags explícitos |

## 7. Criterios de aceptación del proceso de auditoría

- AC-1: Auditoría documentada con severidades y evidencias.
- AC-2: Lista priorizada entregada.
- AC-3: Cada hallazgo crítico/ alto debe tener tarea en `tasks.md`.

## 8. Diseño y tareas

Ver [`design.md`](./design.md) y [`tasks.md`](./tasks.md).
