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

<?php use_helper('I18N') ?>
<?php use_helper('Date') ?>

<?php
if (count($faltas) == 0)
{
  echo __('El alumno ');
  echo $alumno->getNombre();
  echo __(' no tiene ninguna falta');
}
else
{
?>
<div id="titulo">
<h1><?php 
echo __('Alumno: ');
echo $alumno->getNombre();
echo "&nbsp;"; 
echo __('(faltas)'); ?></h1>
</div>
<table cellspacing="0">
<thead>
<tr>
  <th><?php echo __('Fecha') ?></th>
  <?php  
  foreach ($horarios as $horario):
  {
    echo "<th>"; 
    echo include_component('principal','horas',array(
     'hora' => $horario->getHora()
     ));  
    echo "</th>";   
  }
  endforeach; //horarios 
  ?>
</tr>
</thead>
<?php 
$x=1;
$fila = "i";
?> 
<tbody>
<?php 
foreach ($faltas as $falta):  
?>
<tr class="<?php echo $fila ?>">
<td><?php echo format_date($falta->getFecha()); ?></td>
<?php
foreach ($horarios as $horario):
echo "<td>"; 
  if ($horario->getHora() == $falta->getHora())
  {
    echo "X";  
  }
  else 
  { 
    echo "-";  
  }
echo "</td>";
endforeach; //horarios  
$x++; 
if ($x%2 == 0)
{
  $fila = "p";
}
else 
{
  $fila = "i";
} 
echo "</tr>";
endforeach; //faltas
?>
</tbody>
</table>
<?php
}
?>
<div style="margin-top: 1em;">&nbsp;</div>
<?php
if (count($retrasos) == 0)
{
  echo __('El alumno ');
  echo $alumno->getNombre();
  echo __(' no tiene ningún retraso');
}
else
{
?>

<div id="titulo">
<h1><?php 
echo __('Alumno: ');
echo $alumno->getNombre();
echo "&nbsp;"; 
echo __('(retrasos)'); ?></h1>
</div>
<table cellspacing="0">
<thead>
<tr>
  <th><?php echo __('Fecha') ?></th>
  <?php  
  foreach ($horarios as $horario):
  {
    echo "<th>"; 
    echo include_component('principal','horas',array(
     'hora' => $horario->getHora()
     ));  
    echo "</th>";   
  }
  endforeach; //horarios 
  ?>
</tr>
</thead>
<?php 
$x=1;
$fila = "i";
?> 
<tbody>
<?php 
foreach ($retrasos as $retraso):  
?>
<tr class="<?php echo $fila ?>">
<td><?php echo format_date($retraso->getFecha()); ?></td>
<?php
foreach ($horarios as $horario):
echo "<td>";
  if ($horario->getHora() == $retraso->getHora())
  {
    echo "X";  
  }
  else
  {
    echo "-";  
  }
echo "</td>";
endforeach; //horarios 
$x++;
if ($x%2 == 0)
{
  $fila = "p";
}
else
{
  $fila = "i";
} 
echo "</tr>";
endforeach; //retrasos
?>
</tbody>
</table>
<?php
}
?>