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
<h1><?php echo __('Editar grupo') ?></h1>
</div>
<div id="editar">

<?php use_helper('Object') ?>

<?php echo form_tag('grupo/update', 'name=formulario') ?>

<?php echo object_input_hidden_tag($grupo, 'getId') ?>
<?php echo object_input_hidden_tag($grupo, 'getActivo', array (
  'value' => true
  ));   
  ?>

<table cellspacing="0">
<thead>
<tr>
  <th>&nbsp;</th>
  <th><?php echo __('Datos grupo') ?></th>
</tr>
</thead>
<tbody>
<tr>

  <td class="nombres"><label><?php echo __('Nombre') ?>: </label></td><td><?php echo object_input_tag($grupo, 'getNombre', array (
  'size' => 50,
)) ?></td>
</tr>
<tr>

  <td class="nombres"><label><?php echo __('Descripción') ?>: </label></td><td><?php echo object_textarea_tag($grupo, 'getDescripcion', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr>

  <td class="nombres"><label><?php echo __('Tutor') ?>: </label></td><td><?php echo select_tag('profesor_id', objects_for_select(
  ProfesorPeer::doSelect(new Criteria),
  'getId',
  'getNombre',
  $grupo->getProfesorId()
 ))?></td>
</tr>

<tr>

  <td class="nombres"><label><?php echo __('Observaciones') ?>: </label></td><td><?php echo object_textarea_tag($grupo, 'getObservaciones', array (
  'size' => '30x3',
)) ?></td>
</tr>

<tr>

  <td class="nombres"><label><?php echo __('Activo') ?>: </label></td><td><?php echo object_checkbox_tag($grupo, 'getActivo', array (
)) ?></td>
</tr>
</tbody>
</table>

<div id="linea"></div>	
<div class="save">
<?php echo link_to_function(__('Guardar'), "enviar()"); ?>
</div>
<?php if ($grupo->getId()): ?>
  <div class="delete"><?php echo link_to(__('Eliminar'), 'grupo/delete?id='.$grupo->getId(), 'post=true&confirm='.__('Are you sure?')) ?></div>
  <div class="cancel"><?php echo link_to(__('Cancelar'), 'grupo/show?id='.$grupo->getId()) ?></div>
<?php else: ?>
  <div class="cancel"><?php echo link_to(__('Cancelar'), 'grupo/list') ?></div>
<?php endif; ?>
</form>
</div>
</div>