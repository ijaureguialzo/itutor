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
   document.formulario.submit();
  }
") ?>

<div id="listado">
<?php use_helper('Object') ?>

<?php echo form_tag('falta/totalasigalumnolistado', 'name=formulario') ?>
<?php echo input_hidden_tag('fecha', $fecha);?>
<?php echo input_hidden_tag('grupo_id', $grupo);?>

<table cellspacing="0">
<thead>
<tr>
  <th colspan="3"><?php echo __('Listado por asignatura y evaluación') ?></th>
</tr>
</thead>
<tbody>
<tr class="i">
  <?php
  if ($eva_actual)
  {
    $valor_inicial = $eva_actual->getId();
  }
  else
  {
    $valor_inicial = 0;
  }
  ?>
  <td style="height: 40px;"><?php echo __('Escoge evaluación') ?> <?php echo select_tag('evaluacion_id', objects_for_select(
  EvaluacionPeer::doSelect($a),
  'getId',
  'getTitulo',
  $valor_inicial
 ))?>
 </td>
 <td style="height: 40px;"><?php echo __('Escoge asignatura') ?> <?php echo select_tag('asignatura_id', objects_for_select(
  AsignaturaPeer::doSelect($c),
  'getId',
  'getNombre',
  0
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