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
<h1><?php echo __('Comportamientos de alumnos') ?></h1>
</div>
<div id="listado">
<?php use_helper('Object') ?>

<?php echo form_tag('comportamiento/datos', 'name=formulario') ?>
<?php echo input_hidden_tag('fecha', $fecha);?>

<table cellspacing="0">
<thead>
<tr>
  <th colspan="2"><?php echo __('Listado de comportamiento') ?></th>
</tr>
</thead>
<tbody>
<tr class="i">
  <td style="width: 150px; height: 40px;"><?php echo __('Escoge grupo') ?> <?php echo select_tag('grupo', objects_for_select(
  GrupoPeer::doSelect($c),
  'getId',
  'getNombre',
  0
 ))?>
 </td>

  <td>
 <div>
<?php
//echo link_to_function(__('Listado'), "enviar()");
echo submit_to_remote ('Enviar',__('Aceptar'),array(
  'update' => 'listado1',
  'url' => 'comportamiento/datos'
  ));
?>
</div>
</td>
</tr>
</tbody>
</table>
</form>

<div id="listado1">

</div>
</div>
</div>