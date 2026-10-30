# SPEC 002 — Modelo de dominio y módulos de negocio del proyecto iTutor

> **Estado:** APROBADO
> **Responsable:** equipo iTutor / agentes IA

## 1. Contexto

iTutor gestiona el ciclo escolar: profesores, asignaturas, grupos, alumnos,
horarios, horas, perfiles, evaluaciones, pruebas, faltas, comportamiento,
diario y festivos. Todo se expone mediante módulos Symfony 1 con acciones
Propel y plantillas.

Este spec documenta el **diseño funcional y los invariantes de negocio** que
los agentes de IA deben respetar al modificar cualquier módulo.

## 2. Visión

Gestionar de forma fiable el registro académico: evaluaciones con porcentajes
que suman 100, faltas y retrasos, diario docente, horarios, horas por perfil y
cálculos de notas (medias ponderadas) en los listados.

## 3. Alcance

### 3.1 Dentro del alcance

- Módulos de negocio y sus flujos principales.
- Entidades de dominio y relaciones.
- Reglas de negocio (invariantes).

### 3.2 Fuera de alcance

- Implementación de los componentes de framework.
- Cambios de esquema BD no justificados.

## 4. Requisitos

### 4.1 Requisitos funcionales del dominio

- **RF-DM-001**: El profesor administra sus alumnos, grupos, asignaturas y
  evaluaciones.
- **RF-DM-002**: El registro de faltas (`falta`) con justificación y control de
  faltas máximas.
- **RF-DM-003**: El diario docente (`diario`) con actividad y unidad didáctica.
- **RF-DM-004**: Las pruebas (`prueba`) se asignan a evaluación/asignatura con
  porcentaje; las notas (`notaprueba`, `notaevaluacion`, `comportamiento`) se
  registran sobre ellas.
- **RF-DM-005**: Los listados (`listados`) calculan medias ponderadas por
  alumno/asignatura.

### 4.2 Invariantes de negocio

- **RB-1**: La suma de los porcentajes de las pruebas de una evaluación debe ser
  100.
- **RB-2**: No pueden coexistir pruebas con porcentaje 100 y resto < 100 en la
  misma evaluación.
- **RB-3**: Porcentaje por defecto por asignatura: pruebas 80, faltas 10,
  comportamiento 10; `maximofaltas` 10.
- **RB-4**: Faltas: `dia`, `hora`, `fecha`, `justificado`, `observaciones`.
- **RB-5**: Horario: `dia`, `hora`; tramos con `descanso`; asociación
  `Horaperfil` (orden por perfil).

## 5. Criterios de aceptación

- **AC-001**: Toda acción que requiera un registro válido usa
  `forward404Unless`.
- **AC-002**: Las validaciones de negocio redirigen a `principal/error` o
  `principal/warning`.
- **AC-003**: Los mensajes de error se gestionan mediante `executeError` /
  `executeWarning` y plantillas `errorSuccess.php` / `warningSuccess.php`.

## 6. Diseño

Resumen; ver [`design.md`](./design.md).

## 7. Tareas

Resumen; ver [`tasks.md`](./tasks.md).
