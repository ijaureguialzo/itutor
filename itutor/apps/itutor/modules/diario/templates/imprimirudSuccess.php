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
<?php use_helper('Javascript') ?>
<?php use_helper('Object') ?>
<?php echo javascript_tag("
  function imprimir()
  {
   window.print();
  }
") ?>

<div id="contenedor">
<div id="titulo">
<h1><?php echo __('Unidades didácticas del grupo ') ?> <?php echo $grupo->getNombre()?> <?php echo __('en la asignatura de') ?> <?php echo $asignatura->getNombre()?></h1>
<h2><?php echo $evaluacion->getTitulo()?></h2>
</div>
<div id="listado">
<?php 
$actual = $fecha;
?> 
<table cellspacing="0">
<thead>
<tr>
  <th style="width: 600px;"><?php echo __('Unidad didáctica') ?></th>
  <th><?php echo __('Número de horas') ?></th>
      <div style="float: right;">
      <div class="volvercal">
      <?php echo link_to (__('Volver al calendario'), 'diario/list?fecha='.$actual[0]) ?>
      </div>
      <div class="imprimir">
      <?php echo link_to_function(__('Imprimir'), "imprimir()"); ?>
      </div>
      </div>
</tr>
</thead>
<tbody>
<?php 

$x=1;

$total_horas = 0;
$ud = "";

foreach ($diarios as $diario):
$fecha = getdate(strtotime($diario->getFecha()));
if ($diario->getUdidactica())
{
   if ($ud != "")
   {
     if ($x%2 == 0)
     {
        $fila = "p";
     }
     else
     {
        $fila = "i";
     }
   ?>
   <tr class="<?php echo $fila ?>">
   <td class="datos_diario">
      <?php echo $ud; ?>
   </td>
   <td colspan="2">
      <?php 
      echo $total_horas;
      echo " "; 
      if ($total_horas == 1)
      {
        echo __('hora');
      }
      else
      {
        echo __('horas'); 
      }
      ?>
   </td> 
</tr>
<?php
 $x++;
   }
  $ud = $diario->getUdidactica();
  if ($fecha['wday'] >= 1 && $fecha['wday'] <= 5 && $horas[$fecha['wday']] != 0)
  {
    $total_horas = $horas[$fecha['wday']];
  }
}
else
{  
      if ($fecha['wday'] >= 1 && $fecha['wday'] <= 5 && $horas[$fecha['wday']] != 0)
      {
        $total_horas = $total_horas + $horas[$fecha['wday']];
      }
}
endforeach;
if ($x%2 == 0)
{
    $fila = "p";
}
else
{
    $fila = "i";
}
?>
<tr class="<?php echo $fila ?>">
   <td class="datos_diario">
      <?php echo $ud; ?>
   </td>
   <td colspan="2">
      <?php
      echo $total_horas;
      echo " ";
      if ($total_horas == 1)
      {
        echo __('hora');
      }
      else
      {
        echo __('horas');
      }
      ?>
   </td>
</tbody>
</table>

<div id="linea"></div>	
<div class="volvercal">
<?php echo link_to (__('Volver al calendario'), 'diario/index?fecha='.$actual[0]) ?>
</div>
<div class="imprimir">
<?php echo link_to_function(__('Imprimir'), "imprimir()"); ?>
</div>
</div>
</div>
