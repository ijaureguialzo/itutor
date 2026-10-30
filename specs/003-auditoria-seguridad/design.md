# DESIGN — SPEC 003: Auditoría de seguridad del proyecto iTutor

## 1. Contexto

Hallazgos derivados de la auditoría estática del código Symfony 1 / Propel /
sfGuard.

## 2. Decisiones de remedición propuestas

- **D-1 (P0)**: Activar/`escape()` en plantillas. Como la estrategia configurada es
  `bc`, se recomienda usar el helper `escape()` (o pasar a `escaping_strategy: on`
  con `ESC_ENTITIES`) en todas las salidas de plantillas y en mensajes internos.
- **D-2 (P0)**: Eliminar la lectura de `mensaje` desde request en
  `executeError`/`executeWarning`; usar variables internas/flash.
- **D-3 (P0)**: Restaurar el guard de acceso a `itutor_dev.php` (eliminar `die()`
  comentado) o restringir por entorno.
- **D-4 (P1)**: Añadir token CSRF a formularios POST y validación en acciones.
- **D-5 (P1)**: Throttle/brute force en signin.
- **D-6 (P1)**: Forzar HTTPS (redirect) y cookie de sesión `Secure`.

## 3. Alternativas consideradas

- Cambiar de framework (no viable en corto plazo).
- Implementar WAF externo (complementario, no sustituto).

## 4. Riesgos

- Migración a Symfony 2+ implicaría escaping automático; hasta entonces el helper
  `escape()` es la vía.
