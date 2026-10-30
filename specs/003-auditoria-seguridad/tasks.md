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
      parcialmente: redirect HTTPS en `app/web/index.php` (prod).

## Pendientes

- [ ] **P1** — Añadir token CSRF a formularios POST y validación en acciones.
- [ ] **P1** — Implementar rate limiting / brute force protection en login.
- [x] **P2** — Auditar y completar `security.yml` por módulo. → Hecho: añadidos
      `security.yml` con `is_secure: on` + `credentials: admin` a los módulos que
      no los tenían (alumno, asignatura, horario, festivo, diario, falta,
      comportamiento, grupoevaluacion, listados, prueba).
- [ ] **P2** — Endurecer validación de inputs y uploads.
- [ ] **P3** — Revisar hallazgos de sesión.

## Cerrar auditoría

- [ ] Ejecutar batería de seguridad tras cada cambio: `make test`, `make sweep`.
- [ ] Refrescar esta lista hasta dejar todos los hallazgos en estado resuelto.
