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
<h1><?php echo __('Alumnos') ?>
<?php //if ($sf_user->getAttribute('admin') == false && !$sf_user->isSuperAdmin())
{
  echo " del grupo ";
  foreach ($grupos as $grupo):
      if ($grupo->getId() == $grupo_id)
      {
          echo $grupo->getNombre();
      }
  endforeach;
  echo " (".count($alumnos).") "; 
  echo " (";
  echo __('Tutor');
  echo ": ";
  echo $tutor->getNombre();
  echo ")";
}

if ($grupo_id != 0)
{?>
<div class="imprimir" style="float: right; font-size: 9pt; font-weight: normal;">
   <?php echo link_to_function(__('Imprimir fotos'), "imprimir()"); ?>
</div>
<?php
}
?>
</h1>
</div>

<div id="listado_fotos">
<table cellspacing="0">
<tbody>
<tr>
<?php
$y=0;
foreach ($alumnos as $alumno):
if ($y % 5 == 0)
{
    echo "</tr><tr>";
}
?>
      <td>
      <div class="foto">
      <?php $ruta="/itutor/images/grupos/".$alumno->getGrupoId()."/".$alumno->getId().".jpg";?>
      <img src="<?php echo $ruta?>" style="width:100px;" />
      </div>
      <div class="nombre">
      <?php echo $alumno->getNombre(); ?>
      </div>
      </td>
<?php
$y++;
endforeach;
if ($y % 5 != 0)
{
    echo "</tr>";
}
?>

</tbody>
</table>

</div>
</div>

