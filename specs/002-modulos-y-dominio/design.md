# DESIGN — SPEC 002: Modelo de dominio y módulos de negocio de iTutor

## 1. Contexto

El dominio se organiza en módulos Symfony 1 bajo `app/apps/itutor/modules/`.

## 2. Mapa de módulos

| Módulo | Recursos / acciones clave | Entidades |
| ------ | ------------------------- | --------- |
| `principal` | `index`, `error`, `warning`, `logout`; componentes `cabecera`, `menu`, `dias`, `horas`, `meses` | usuario, permisos |
| `alumno` | `index, list, listado, datos, fotos, show, create, edit, update, delete, imagendelete` | alumno, grupo |
| `asignatura` | `index, list, show, create, edit, update, error, delete` | asignatura, profesor, grupo |
| `profesor` | CRUD | profesor, perfil |
| `grupo` | CRUD | grupo, profesor |
| `horario` | CRUD + `completo, editdia, updatedia, error` | horario, grupo, asignatura |
| `hora` | CRUD + `perfilhora*` | hora, horaperfil, perfil |
| `perfil` | CRUD + `perfilhora*` | perfil, hora |
| `festivo` | CRUD + `festivo` | festivo, evaluacion |
| `diario` | CRUD + `grupodia, diario, opciongrupo, generar, regenerar, imprimir, imprimirud, listado, updateall, update` | diario, evaluacion, asignatura, grupo, profesor |
| `evaluacion` | CRUD | evaluacion, grupo, asignatura |
| `falta` | Muy numerosos flows: `listado, grupolisteval, grupoev, tabla, tablalist, tablafaltas, salvartodo, salvar, limpiar, l imp, total*, asig*, totalalumn*, alumnolisteval, ...` | falta, retraso, evaluacion, alumno, asignatura, grupo |
| `prueba` | CRUD + `nuevo, listado, alumnolist, notasedit, notasupdate, error` | prueba, evaluacion, asignatura, alumno, nota |
| `prueba_viejo` | **ELIMINADO** (módulo legacy huérfano, sin referencias activas) | — |
| `comportamiento` | CRUD + `generar, regenerar, updateall` | comportamiento, evaluacion, alumno, nota |
| `grupoevaluacion` | CRUD | grupo, evaluacion |
| `listados` | `index, grupoev, alasiglist, guardarnota, grupoasiglist, grupoasigresumenlist, alresumenlist, alresumenlistpdf, algrupolist` | notas, medias |
| `pdf` | `index, test, test2` | TCPDF |

### 3.1 Invariantes y flujos

- **IF-1**: Porcentajes de evaluación: suma = 100; prueba con % 100 excluye
  otras pruebas de la misma evaluación.
- **IF-2**: Errores numerados: `error == 1` (prueba % 100 con resto < 100) y
  `error == 2` (suma porcentajes ≠ 100).

## 3. Decisiones de diseño

- El módulo `listados` concentra las **comprobaciones de porcentajes** y el
  cálculo de medias ponderadas (tanto en acción como en plantillas).
- Los flujos de faltas y pruebas gestionan **filtros por fecha**
  (`?fecha=`), por grupo (`?grupo_id=`), asignatura (`?asignatura_id=`),
  profesor (`ProfesorPeer::CODIGO` desde atributo de usuario).

## 4. Riesgos

- Lógica duplicada entre acciones y plantillas en `listados`.
- Acciones legacy (`falta`, `diario`, `prueba`) con muchos flows paramétricos.

## 5. Tareas

- [ ] Refactorizar flujos paramétricos en acciones legacy priorizando bugs críticos.
- [ ] Centralizar cálculo de medias/porcentajes en una única capa.
