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
<?php use_helper('Date') ?>
<?php use_helper('I18N') ?>
<div id="contenedor">
<div id="titulo">
<h1><?php echo __('Visualizar diario') ?></h1>
</div>
<div id="mostrar">

<table cellspacing="0">
<thead>
<tr>
  <th>&nbsp;</th>
  <th id="sf_admin_list_th_id"><?php echo __('Datos diario') ?></th>
</tr>
</thead>
<tbody>
<tr>
<th><?php echo __('Id') ?>: </th>
<td class="i"><?php echo $diario->getId() ?></td>
</tr>
<tr>
<th><?php echo __('Profesor') ?>: </th>
<td class="p"><?php echo $profesor->getNombre() ?></td>
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
<th><?php echo __('Grupo') ?>: </th>
<td class="i"><?php echo $grupo->getNombre() ?></td>
</tr>
<tr>
<th><?php echo __('Fecha') ?>: </th>
<td class="p"><?php 
   //Obtenemos el formato para las fechas 
   if ($sf_user->getCulture() == 'es')
   {
      $formato = 'd-m-Y';   
   } 
   if ($sf_user->getCulture() == 'eu')
   {
      $formato = 'Y-m-d';   
   }  
   
   echo date($formato,strtotime($diario->getFecha()))
 ?></td>
</tr>
<tr>
<th><?php echo __('Actividad') ?>: </th>
<td class="i"><?php echo $diario->getActividad() ?></td>
</tr>
<tr>
<th><?php echo __('Actualizado') ?>: </th>
<td class="p"><?php echo $diario->getUpdatedAt() ?></td>
</tr>
</tbody>
</table>
<div id="linea"></div>	
<div class="edit">
<?php echo link_to(__('Editar'), 'diario/edit?id='.$diario->getId()) ?>
</div>
<div class="list">
<?php echo link_to(__('Listado'), 'diario/list?fecha='.strtotime($diario->getFecha())) ?>
</div>
<div class="calendar">
<?php echo link_to(__('Calendario'), 'diario/index?fecha='.strtotime($diario->getFecha())) ?>
</div>
</div>
</div>