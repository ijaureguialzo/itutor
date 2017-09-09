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
<h1><?php echo __('Notas de alumnos de') ?> <?php echo $grupo->getNombre()?></h1>
</div>
<div id="listado">

<?php use_helper('Object') ?>

<?php echo form_tag('prueba/notasupdate', 'name=formulario') ?>

<?php echo input_hidden_tag('grupo', $grupo->getId()) ?>  
<?php echo input_hidden_tag('prueba', $prueba->getId()) ?> 
<?php echo input_hidden_tag('grupoid', $grupoid) ?> 

<table cellspacing="0">
<thead>
<tr>
  <th><?php echo __('Alumno') ?></th>
  <th><?php echo __('Nota') ?></th>
  <th><?php echo __('Observaciones') ?></th>
</tr>
</thead>
<tbody>
<?php 
$x=1;
foreach ($alumnos as $alumno): 
if ($x%2 == 0)
{
  $fila = "p";
}
else
{
  $fila = "i";
}
?> 
<?php echo object_input_hidden_tag($notas[$alumno->getId()], 'getId', array (
  'id' => 'id'.$alumno->getId(),
  'name' => 'id'.$alumno->getId()
));
?>

<?php echo object_input_hidden_tag($notas[$alumno->getId()], 'getAlumnoId', array (
  'id' => 'id_alum'.$alumno->getId(),
  'name' => 'id_alum'.$alumno->getId()
));
?>

<?php echo object_input_hidden_tag($notas[$alumno->getId()], 'getActivo', array (
  'id' => 'a'.$alumno->getId(),
  'name' => 'a'.$alumno->getId()
));
?>

<tr class="<?php echo $fila ?>">
   <td><?php echo $alumno->getNombre() ?></td>
   <td><?php 
       echo object_input_tag($notas[$alumno->getId()], 'getNota', array (
  'size' => 7,
  'id' => 'n'.$alumno->getId(),
  'name' => 'n'.$alumno->getId()
));
   ?></td>
   <td><?php 
       echo object_textarea_tag($notas[$alumno->getId()], 'getObservaciones', array (
  'size' => '30x1',
  'id' => 'o'.$alumno->getId(),
  'name' => 'o'.$alumno->getId()
));
   ?></td>
</tr>
<?php 
$x++;
endforeach; ?>
</tbody>
</table>


<div id="linea"></div>	
<div class="save">
<?php echo link_to_function(__('Guardar'), "enviar()"); ?>
</div>
<?php if ($prueba->getId()): ?>
  <div class="cancel"><?php 
  echo link_to(__('Cancelar'), 'prueba/alumnolist?prueba='.$prueba->getId().'grupo='.$grupo->getId().'&grupoid='.$grupoid.'&fecha='.strtotime($prueba->getFecha()));
  ?> 
<?php else: ?>
  <div class="cancel"><?php echo link_to(__('Cancelar'), 'prueba/index?fecha='.strtotime($prueba->getFecha())) ?></div>
<?php endif; ?>
</form>
</div>
</div>
</div>
