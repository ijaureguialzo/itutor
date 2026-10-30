# Índice y proceso SDD — iTutor

Este directorio contiene las especificaciones del proyecto **iTutor**
desarrolladas con **Spec-Driven Development (SDD)**: primero se escribe el
spec, luego el diseño y el desglose de tareas, y solo después se implementa.

## Convención de ubicación

Las especificaciones se organizan en subdirectorios numerados:

```
specs/
  001-<nombre>/
    spec.md     # Especificación: contexto, visión, alcance, requisitos, criterios
    design.md   # Diseño: decisiones técnicas, arquitectura, alternativas
    tasks.md    # Tareas: desglose con estados (pendiente / en progreso / hecho)
```

## Plantilla mínima de una especificación

1. **Contexto** — situación actual relevante.
2. **Visión** — objetivo del cambio / área.
3. **Alcance** — dentro (In) y fuera (Out) de lo que se especifica.
4. **Requisitos** — funcionales y no funcionales, con IDs (RF-x / NFR-x).
5. **Criterios de aceptación** — verificables (AC-x).
6. **Diseño** — decisiones, alternativas, componentes (en `design.md`).
7. **Tareas** — pasos con criterios de aceptación (en `tasks.md`).

## Índice de specs

### [001 — arquitectura-y-stack](./001-arquitectura-y-stack/)

Especificación del stack, runtime, entorno, despliegue, calidad y pruebas de
iTutor.

- `spec.md` — visión, alcance, requisitos (RF/NFR), criterios de aceptación.
- `design.md` — decisiones técnicas y arquitectura de la solución.
- `tasks.md` — tareas de migración y calidad con estados.

### [002 — modulos-y-dominio](./002-modulos-y-dominio/)

Especificación del modelo de dominio y módulos de negocio de iTutor.

- `spec.md` — visión, alcance, requisitos funcionales del dominio, invariantes.
- `design.md` — mapa de módulos, rutas, acciones y plantillas por módulo.
- `tasks.md` — tareas pendientes de negocio.

## Proceso SDD aplicado en iTutor

1. **Descubrimiento / propuesta**: el agente propone un spec para el cambio.
2. **Especificación**: redactar `spec.md` (qué y por qué).
3. **Diseño**: redactar `design.md` (cómo), revisar riesgos.
4. **Tareas**: desglosar en `tasks.md` con criterios de aceptación.
5. **Implementación**: ejecutar tareas en orden; marcar estados.
6. **Revisión**: ejecutar calidad (`make test`, `make sweep`) y actualizar docs.

## Reglas para agentes IA

- Toda modificación relevante del comportamiento o la arquitectura debe tener un
  spec vigente en `specs/`.
- Antes de tocar código: leer `AGENTS.md` y el spec correspondiente.
- Si un cambio no tiene spec, se debe crear una antes de implementar.
- Al cerrar tareas: actualizar `tasks.md` y reflejar el cambio en los docs.
- Los commits se crean siguiendo **Conventional Commits** e incluyen el
  trailer de co-autoría del agente (`Co-authored-by: <modelo> <email>`).
- Ejemplo: `docs(spec): añadir especificaciones SDD para agentes IA`.
