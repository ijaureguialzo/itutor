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
<?php echo javascript_tag("
  function imprimir()
  {
   window.print();
  }
") ?>
<div id="contenedor">
<div id="titulo">
<h1>
<?php echo __('Faltas del grupo') ?> <?php echo $grupo->getNombre()?> <?php echo __('en la ') ?><?php echo $evaluacion->getTitulo()?>
<div class="imprimir" style="float: right; font-size: 9pt; font-weight: normal;">
   <?php echo link_to_function(__('Imprimir'), "imprimir()"); ?>
</div>
</h1>
</div>

<?php
foreach ($asignaturas as $asignatura):
    $tiene = false;
    foreach ($faltas as $falta):
            if ($falta->getAsignaturaId() == $asignatura->getId())
            {
               $tiene = true;
            }
    endforeach;
  if ($tiene)
  {?>
  <div class="falta_titulo">
  <div class="subtitulo1">
  <h2><?php echo __('Asignatura') ?> <?php echo $asignatura->getNombre()?></h2>
  </div>
  </div>
  
<?php
  }
foreach ($alumnos as $alumno):
    $tiene = false;
    foreach ($faltas as $falta):
            if ($falta->getAlumnoId() == $alumno->getId() && $falta->getAsignaturaId() == $asignatura->getId())
            {
               $tiene = true;
            }
    endforeach;

if ($tiene)
{?>
<div class="subtitulo2_faltas">
<h3><?php echo __('Faltas del alumno') ?> <?php echo $alumno->getNombre()?></h3>
</div>
<div id="listado">
<table cellspacing="0">
<thead>
<tr>
  <th><?php echo __('Dia') ?></th>
  <th><?php echo __('Hora') ?></th>
  <th><?php echo __('Fecha') ?></th>
  <th><?php echo __('Justificado') ?></th>
</tr>
</thead>
<tbody>
<?php 
$x=1;
$total = 0;
$justif = 0;
$nojustif = 0;
foreach ($faltas as $falta): 
if ($falta->getAlumnoId() == $alumno->getId())
{
 if ($falta->getAsignaturaId() == $asignatura->getId())
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

  <td class="faltas"><?php
      include_component ('principal','dias', array (
      'dia' => $falta->getDia() 
      ));?></td>

  <td class="faltas"><?php
      include_component ('principal','horas', array (
      'hora' => $falta->getHora(),
      'asignatura' => $falta->getAsignaturaId()
      ));?></td>
  <td class="faltas"><?php
  if ($sf_user->getCulture() == 'es')
    {  
     echo date('d-m-Y',strtotime($falta->getFecha())); 
    }
    if ($sf_user->getCulture() == 'eu')
    {  
     echo date('Y-m-d',strtotime($falta->getFecha())); 
    }
   ?></td>
  <td class="faltas"><?php
  if ($falta->getJustificado())
  {
    echo "SI";
    $justif++;  
  }
  else
  {
    echo "NO"; 
    $nojustif++; 
  }
  ?></td></tr>
<?php
$x++;
$total++;
}
}
endforeach; ?>
</tbody>
</table>
</div>
<div class="subtitulo3_faltas">
<h3><?php echo __('Total de faltas') ?> <?php echo $total?> | <?php echo __('Faltas sin justificar') ?> <?php echo $nojustif?> | <?php echo __('Faltas justificadas') ?> <?php echo $justif?></h3>
</div>
<?php
}
endforeach;
endforeach;
?>
<div id="linea"></div>
<div class="exit">
<?php 
echo link_to(__('Volver'), 'falta/grupolisteval?fecha='.$fecha); 
?>
</div>	
</div>



