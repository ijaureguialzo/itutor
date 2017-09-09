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
<div id="titulo" style="text-align: center;">
<h1><?php echo __('Calendario para editar festivos') ?></h1>
</div>
<div id="calendario">
<table cellspacing="0">
<thead>
<tr>
  <th style="text-align: left; padding-left: 5px;"><?php echo link_to(image_tag('/images/iconos/date_previous.png'),'festivo/index?fecha='.strtotime("-1 month",$fecha[0]))?></th>
  <th colspan="5" ><?php include_component('principal','meses',array(
     'mes' => $fecha['mon'] 
     ));?> - <?php echo $fecha['year'] ?></th>
  <th style="text-align: right; padding-right: 5px;"><?php echo link_to(image_tag('/images/iconos/date_next.png'),'festivo/index?fecha='.strtotime("+1 month",$fecha[0]))?></th>
</tr>
<tr>
  <th>&nbsp;</th>
  <th><?php echo __('L') ?></th>
  <th><?php echo __('M') ?></th>
  <th><?php echo __('X') ?></th>
  <th><?php echo __('J') ?></th>
  <th><?php echo __('V') ?></th>
  <th>&nbsp;</th>
</tr>
</thead>
<tbody>
  <?php
   //Obtenemos el formato para las fechas 
   if ($sf_user->getCulture() == 'es')
   {
      $formato = 'd/m/Y';   
   } 
   if ($sf_user->getCulture() == 'eu')
   {
      $formato = 'Y/m/d';   
   }  
  
  //Metemos los festivos en un array
  $fest = array();
  $p = 0;
  foreach ($festivos as $festivo):
    $date = getdate(strtotime($festivo->getFecha()));
    if ($date['mon'] == $fecha['mon'])
    {
      $fest[$p] = $date['mday'];
      $p++;
    }
  endforeach;
  //Terminan los arrays de festivos
  
  
  $x = 1;
  while ($x <= $dias)
  {
    $encontrado = false; 
    $fecha = getdate(mktime(0, 0, 0, $fecha['mon'], $x , $fecha['year']));
    if ($fecha['wday'] != 6 && $fecha['wday'] != 0) 
    {
    ?>
    <tr>
    <td class="blanco">&nbsp;</td>
    <?php
    }      
    switch($fecha['wday'])
   {
    case 1:
      $num_blancos = 0;
      $dias_suma = 2;
      break; 
    case 2:
      $num_blancos = 1;
      $dias_suma = 2;
      break; 
    case 3:
       $num_blancos = 2;
       $dias_suma = 2;
       break; 
    case 4:
      $num_blancos = 3;
      $dias_suma = 2;
      break; 
    case 5:
      $num_blancos = 4;
      $dias_suma = 2;
      break; 
    case 6:
      $num_blancos = 5;
      $dias_suma = 2;
      break; 
    case 0:
      $num_blancos = 5;
      $dias_suma = 1;
      break;    
  }
  if ($num_blancos != 5)
  {
  for ($r=0;$r<$num_blancos;$r++)
  { 
    echo "<td>&nbsp;</td>";
  }
  for($r=0;$r<(5-$num_blancos);$r++)
  {
    if ($x <= $dias)
      {
      if (count($fest) != 0)
        {
          $encontrado = false;
          for($z=0; $z<count($fest) && $fest[$z]!=$x; $z++);
          if ($z<count($fest))
          {
            $encontrado = true;
          }
        }
        if ($encontrado == false)
        {
        echo "<td>";
        }
        else
        {?>
          <td class="festivo">
          <?php
        }

        $dia = mktime(0, 0, 0, $fecha['mon'], $x , $fecha['year']); 
        echo link_to($x,'festivo/festivo?dia='.$dia);
      }
      else
      {
        echo "<td>";
        echo "&nbsp;"; 
      }?></td>
  <?php 
    $x++;
  }?>
  <td class="blanco">&nbsp;</td>
  </tr>
  <?php  
  }
  $x = $x + $dias_suma; 
} 
  ?>
</tbody>
</table>

<div id="linea"></div>
<div class="list">
<?php echo link_to (__('Listado de festivos'), 'festivo/list?fecha='.$fecha[0]) ?>
</div>	
</div>
</div>

