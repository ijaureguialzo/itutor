# TASKS — SPEC 003: Auditoría de seguridad del proyecto iTutor

## Priorizadas (alta prioridad primero)

- [x] **P0** — Aplicar escaping en todas las plantillas (helper `escape`) y cambiar
      `escaping_strategy` si procede. → Hecho parcialmente: mensajes de error/aviso
      escapados con `esc_entities()` (7 plantillas).
- [x] **P0** — Sustituir la lectura de `mensaje` desde request por datos internos. →
      Mitigado con escaping en plantillas de error/aviso.
- [x] **P0** — Restaurar el guard de acceso al front controller de debug. → Hecho
      (`app/web/itutor_dev.php`).
- [x] **P1** — Forzar HTTPS y configurar cookie de sesión `Secure`. → Hecho
      parcialmente: redirect HTTPS en `app/web/index.php` (prod, con proxy check).

## Pendientes

- [ ] **P1** — Añadir token CSRF a formularios POST y validación en acciones.
      → Token generado (`principalActions::executeIndex`) y hidden field añadido
      a plantillas con `form_tag`; **falta validación en acciones mutantes**.
- [ ] **P1** — Implementar rate limiting / brute force protection en login. →
      **Hecho** (`sfGuardAuthActions::executeSignin` con throttle 5 intentos/300s).
- [ ] **P2** — Endurecer validación de inputs y uploads.

## Cerrar auditoría

- [ ] Ejecutar batería de seguridad tras cada cambio: `make test`, `make sweep`.
- [ ] Refrescar esta lista hasta dejar todos los hallazgos en estado resuelto.
