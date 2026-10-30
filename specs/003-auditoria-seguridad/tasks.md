# TASKS — SPEC 003: Auditoría de seguridad del proyecto iTutor

## Priorizadas (alta prioridad primero)

- [x] **P0** — Aplicar escaping en todas las plantillas (helper `escape`) y cambiar
      `escaping_strategy` si procede.
- [x] **P0** — Sustituir la lectura de `mensaje` desde request por datos internos.
- [x] **P0** — Restaurar el guard de acceso al front controller de debug.
- [ ] **P1** — Añadir token CSRF a formularios POST y validación en acciones.
- [ ] **P1** — Implementar rate limiting / brute force protection en login.
- [ ] **P1** — Forzar HTTPS y configurar cookie de sesión `Secure`.
- [ ] **P2** — Auditar y completar `security.yml` por módulo.
- [ ] **P2** — Endurecer validación de inputs y uploads.

## Pendientes

- [ ] Revisar hallazgos P3 (sesión).
