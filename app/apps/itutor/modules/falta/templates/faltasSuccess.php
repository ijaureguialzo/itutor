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
<h1><?php echo __('Faltas del alumno') ?>: <?php echo $alumno->getNombre()?></h1>
</div>
<div id="listado">
<table cellspacing="0">
<thead>
<tr>
  <th><?php echo __('Id') ?></th>
  <th><?php echo __('Evaluacion') ?></th>
  <th><?php echo __('Asignatura') ?></th>
  <th><?php echo __('Dia') ?></th>
  <th><?php echo __('Hora') ?></th>
  <th><?php echo __('Fecha') ?></th>
  <th><?php echo __('Justificado') ?></th>
</tr>
</thead>
<tbody>
<?php 
$x=1;
foreach ($faltas as $falta): 
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
  <td><?php echo link_to($falta->getId(), 'falta/show?id='.$falta->getId().'&fecha='.$fecha) ?></td>
  <td><?php 
  foreach ($evaluaciones as $evaluacion):
   if ($evaluacion->getId() == $falta->getEvaluacionId())
   {
      echo $evaluacion->getTitulo();   
   }  
  endforeach;?></td>
  <td><?php echo $asig->getNombre() ?></td>
  <td><?php 
      include_component ('principal','dias', array (
      'dia' => $falta->getDia() 
      ));?></td>
  <td><?php 
      include_component ('principal','horas', array (
      'hora' => $falta->getHora() 
      ));?></td>
  <td><?php
  $f = strtotime($falta->getFecha());
  if ($sf_user->getCulture() == 'es')
  {
    echo date('d-m-Y',$f);  
  } 
  if ($sf_user->getCulture() == 'eu')
  {
    echo date('Y-m-d',$f);  
  }
  ?></td>
  <td><?php 
  if ($falta->getJustificado())
  {
    echo __('SI');  
  }
  else
  {
    echo __('NO');   
  }
  ?></td>
<?php
$x++; 
endforeach; ?>
</tbody>
</table>

<div id="linea"></div>
<div class="exit">
<?php 
echo link_to(__('Volver'), 'falta/list?grupo='.$alumno->getGrupoId().'&dia='.$dia.'&hora='.$hora.'&asignatura='.$asignatura.'&fecha='.$fecha); 
?>
</div>	
</div>
</div>
