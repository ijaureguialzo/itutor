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

<?php use_helper('Javascript') ?>
<?php use_helper('Date') ?> 
<?php use_helper('I18N') ?>
<?php use_helper('Object') ?>
<?php echo javascript_tag("
  function enviar()
  {
   document.formulario1.submit();
  }
") ?>

<div id="listado">
<?php use_helper('Object') ?>

<?php echo form_tag('comportamiento/list', 'name=formulario1') ?>
<?php echo input_hidden_tag('fecha', $fecha);?>
<?php echo input_hidden_tag('grupo', $grupo);?>

<table cellspacing="0">
<thead>
<tr>
  <th colspan="3"><?php echo __('Listado de comportamiento') ?></th>
</tr>
</thead>
<tbody>
<tr class="i">
 <td style="height: 40px;"><?php echo __('Escoge asignatura') ?> <?php echo select_tag('asignatura', objects_for_select(
  AsignaturaPeer::doSelect($g),
  'getId',
  'getNombre',
  0
 ))?>
 </td>
   <?php
   if ($eva_actual)
   {
      $selec = $eva_actual->getId();
   }
   else
   {
     $selec = 0;
   }
   ?>
  <td style="height: 40px;"><?php echo __('Escoge evaluación') ?> <?php echo select_tag('evaluacion', objects_for_select(
  EvaluacionPeer::doSelect($a),
  'getId',
  'getTitulo',
  $selec
 ))?>
 </td>
 <td>
 <!--<div class="list_alum">-->
<?php 
//echo link_to_function(__('Listado'), "enviar()"); 
echo submit_tag(__('Listado'));
?> 
<!--</div>-->
</td>
</tr>
</tbody>
</table>
<hr />
</form>