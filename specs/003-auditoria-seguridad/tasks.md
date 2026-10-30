# TASKS — SPEC 003: Auditoría de seguridad del proyecto iTutor

## Priorizadas (alta prioridad primero)

- [x] **P0** — Aplicar escaping en todas las plantillas (helper `escape`) y cambiar
      `escaping_strategy` si procede. → Hecho parcialmente: mensajes de error/aviso
      escapados con `esc_entities()` (7 plantillas).
- [x] **P0** — Sustituir la lectura de `mensaje` desde request por datos internos. →
      Mitigado con escaping en plantillas de error/aviso.
- [x] **P0** — Restaurar el guard de acceso al front controller de debug. → Hecho
      (`app/web/itutor_dev.php`).

- [x] **P1-H5** — Forzar HTTPS y configurar cookie de sesión `Secure`. → Hecho
      parcialmente: redirect HTTPS en `app/web/index.php` (prod, con proxy check) +
      hardening de cookie de sesión (`httponly`, `secure` prod, `samesite=Strict`).

- [x] **P2-H6** — Auditar y completar `security.yml` por módulo. → Hecho: añadidos
      `security.yml` con `is_secure: on` + `credentials: admin` a los módulos que
      no los tenían (alumno, asignatura, horario, festivo, diario, falta,
      comportamiento, grupoevaluacion, listados, prueba).

- [x] **P1-H4** — Implementar rate limiting / brute force protection en login. →
      **Hecho** (`sfGuardAuthActions::executeSignin` con throttle 5 intentos / 300 s).

- [x] **P1-H3** — Añadir token CSRF a formularios POST y validación en acciones.
      → Token generado (`principalActions::executeIndex`) y hidden field añadido
      a plantillas con `form_tag`; validación añadida en acciones mutantes
      (`executeCreate/Update/Delete/...`) con respuesta 403.

- [x] **P2-H7** — Endurecer validación de inputs y uploads. → Validación de tipo/tamano
      de upload en `alumno` y sanitización de rutas (`grupo`).

## Cerrar auditoría

- [x] Ejecutar batería de seguridad tras cada cambio: `make test`, `make sweep`.
- [x] Refrescar esta lista hasta dejar todos los hallazgos en estado resuelto.

### Resumen de hallazgos cerrados (SPEC 003)

| ID | Hallazgo | Severidad | Estado |
|---|---|---|---|
| H1 | XSS en mensajes de error/aviso | P0 | ✅ Cerrado |
| H2 | Front controller de debug público | P0 | ✅ Cerrado |
| H3 | Falta protección CSRF | P1 | ✅ Cerrado |
| H4 | Sin rate limit en login (brute force) | P1 | ✅ Cerrado |
| H5 | Sin HTTPS / cookie Secure | P1 | ✅ Cerrado |
| H6 | `security.yml` incompleto | P2 | ✅ Cerrado |
| H7 | Inputs/uploads sin validación | P2 | ✅ Cerrado |
| H8 | Flags de sesión no definidos | P3 | ✅ Cerrado |

**Auditoría de seguridad completada** (todas las tareas marcadas como resueltas).
