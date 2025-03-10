<?php

/*
  This file is part of iTutor.
  Copyright (C) 2008 Oihane Garcia Bolumburu <oihaneg@gmail.com>
  Copyright (C) 2008 Ion Jaureguialzo Sarasola <widemos@gmail.com>

  iTutor is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  iTutor is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with iTutor. If not, see <http://www.gnu.org/licenses/>.
*/

?>
<?php
// auto-generated by sfPropelCrud
// date: 2007/12/04 09:35:39
?>
<?php use_helper('Javascript') ?>
<?php use_helper('Date') ?> 
<?php use_helper('I18N') ?>
<?php echo javascript_tag("
  function enviar()
  {
   document.formulario.submit();
  }
") ?>

<div id="contenedor">
<div id="titulo">
<h1><?php echo __('Visualizar comportamiento') ?></h1>
</div>
<div id="mostrar">

<table cellspacing="0">
<thead>
<tr>
  <th>&nbsp;</th>
  <th id="sf_admin_list_th_id"><?php echo __('Datos comportamiento') ?></th>
</tr>
</thead>
<tbody>
<tr>
<th><?php echo __('Id') ?>: </th>
<td class="i"><?php echo $comportamiento->getId() ?></td>
</tr>
<tr>
<th><?php echo __('Alumno') ?>: </th>
<td class="p"><?php echo $alumno->getNombre() ?></td>
</tr>
<tr>
<th><?php echo __('Evaluacion') ?>: </th>
<td class="i"><?php echo $evaluacion->getTitulo() ?></td>
</tr>
<tr>
<th><?php echo __('Asignatura') ?>: </th>
<td class="p"><?php echo $asignatura->getNombre() ?></td>
</tr>
<tr>
<th><?php echo __('Nota') ?>: </th>
<td class="i"><?php echo $comportamiento->getNota() ?></td>
</tr>
<tr>
<th><?php echo __('Observaciones') ?>: </th>
<td class="p"><?php echo $comportamiento->getObservaciones() ?></td>
</tr>
<tr>
<th><?php echo __('Actualizado') ?>: </th>
<td class="i"><?php echo $comportamiento->getUpdatedAt() ?></td>
</tr>
</tbody>
</table>

<div id="linea"></div>	
<div class="edit">
<?php echo link_to(__('Editar'), 'comportamiento/edit?id='.$comportamiento->getId().'&grupo='.$grupo) ?>
</div>
<?php echo form_tag('comportamiento/list', 'name=formulario') ?>
<?php echo input_hidden_tag('grupo', $grupo) ?>
<?php echo input_hidden_tag('asignatura', $comportamiento->getAsignaturaId()) ?>
<?php echo input_hidden_tag('evaluacion', $comportamiento->getEvaluacionId()) ?>
<div class="list">
<?php echo link_to_function(__('Listado'), "enviar()"); ?>
</div>
</form>
</div>
</div>