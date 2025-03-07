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
<h1><?php echo __('Editar comportamiento') ?></h1>
</div>
<div id="editar">

<?php use_helper('Object') ?>

<?php echo form_tag('comportamiento/update', 'name=formulario') ?>

<?php echo object_input_hidden_tag($comportamiento, 'getId') ?>
<?php echo input_hidden_tag('grupo', $grupo) ?>
<?php echo input_hidden_tag('asignatura', $comportamiento->getAsignaturaId()) ?>
<?php echo input_hidden_tag('evaluacion', $comportamiento->getEvaluacionId()) ?>
<?php echo input_hidden_tag('alumno', $comportamiento->getAlumnoId()) ?>

<?php echo object_input_hidden_tag($comportamiento, 'getActivo', array (
  'value' => true
  )); ?>

<table cellspacing="0">
<thead>
<tr>
  <th>&nbsp;</th>
  <th><?php echo __('Datos comportamiento') ?></th>
</tr>
</thead>
<tbody>
<tr>
  <td class="nombres"><label><?php echo __('Alumno') ?>: </label></td><td>
  <?php echo $alumno->getNombre()?></td>
</tr>
<tr>
  <td class="nombres"><label><?php echo __('Evaluacion') ?>: </label></td><td>
  <?php echo $evaluacion->getTitulo()?></td>
</tr>
<tr>
  <td class="nombres"><label><?php echo __('Asignatura') ?>: </label></td><td>
  <?php echo $asignatura->getNombre()?></td>
</tr>
<tr>
 
  <td class="nombres"><label><?php echo __('Nota') ?>: </label></td><td><?php echo object_input_tag($comportamiento, 'getNota', array (
  'size' => 7,
)) ?></td>
</tr>
<tr>
 
  <td class="nombres"><label><?php echo __('Observaciones') ?>: </label></td><td><?php echo object_textarea_tag($comportamiento, 'getObservaciones', array (
  'size' => '30x3',
)) ?></td>
</tr>
</tbody>
</table>
<div id="linea"></div>	
<div class="save">
<?php echo link_to_function(__('Guardar'), "enviar()"); ?>
</div>
<?php if ($comportamiento->getId()): ?>
  <div class="delete"><?php echo link_to(__('Eliminar'), 'comportamiento/delete?id='.$comportamiento->getId(), 'post=true&confirm='.__('Are you sure?')) ?></div>
  <div class="cancel"><?php echo link_to(__('Cancelar'), 'comportamiento/show?id='.$comportamiento->getId().'&grupo='.$grupo) ?></div>
<?php else: ?>
  <div class="cancel"><?php echo link_to(__('Cancelar'), 'comportamiento/list?asignatura='.$comportamiento->getAsignaturaId().'&grupo='.$grupo.'&evaluacion='.$comportamiento->getEvaluacionId()) ?></div>
<?php endif; ?>
</form>
</div>
</div>