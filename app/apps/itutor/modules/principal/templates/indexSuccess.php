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
<?php use_helper('Date') ?>
<?php use_helper('I18N') ?>
<div id="contenedor">
<div id="titulo">
<h1><?php echo __('Bienvenido a la aplicación de gestión de alumnos') ?></h1>
</div>
  <div style="padding: 1em;">
  <div style="float: left; width: 20%;">&nbsp;</div>
   <div style="float: left; width: 70%; text-align: center; font-size: 130%; font-weight: bold;">
    <?php
    $d = strtotime("now"); 
      if (!$sf_user->isSuperAdmin() && $admin == false)
      { 
      ?>
      <div style="float: left; width: 30%; border: 1px solid #ccc;">
      <?php echo link_to(image_tag('/images/iconos/asignaturas.png'),'asignatura/list'); ?>
      <div>
      <?php echo link_to(__('Asignaturas'),'asignatura/list'); ?>
      </div>
      </div>
      <div style="float: left; width: 30%; border: 1px solid #ccc;">
      <?php echo link_to(image_tag('/images/iconos/reloj.png'),'horario/completo'); ?>
      <div>
      <?php echo link_to(__('Horario'),'horario/completo'); ?>
      </div>
      </div>
      <?php if ($grupo)
	    {?>
      <div style="float: left; width: 30%; border: 1px solid #ccc;">
      <?php echo link_to(image_tag('/images/iconos/alumnos.png'),'alumno/index?grupo_id='.$grupo->getId()); ?>
      <div>
      <?php echo link_to(__('Alumnos'),'alumno/index?grupo_id='.$grupo->getId()); ?>
      </div>
      </div>
      <?php
      } 
      if ($sf_user->getAttribute('asignaturas') == true && $sf_user->getAttribute('horario') == true)
      {
      ?>
        <div style="float: left; width: 30%; border: 1px solid #ccc;">
        <?php echo link_to(image_tag('/images/iconos/faltas.png'),'falta/index?fecha='.$d); ?>
        <div>
        <?php echo link_to(__('Faltas'),'falta/index?fecha='.$d); ?>
        </div>
        </div>
        <div style="float: left; width: 30%; border: 1px solid #ccc;">
        <?php echo link_to(image_tag('/images/iconos/pruebas.png'),'prueba/index?fecha='.$d); ?>
        <div>
        <?php echo link_to(__('Pruebas'),'prueba/index?fecha='.$d); ?>
        </div>
        </div>
        <div style="float: left; width: 30%; border: 1px solid #ccc;">
        <?php echo link_to(image_tag('/images/iconos/comportamiento.png'),'comportamiento/index'); ?>
        <div>
        <?php echo link_to(__('Comportamiento'),'comportamiento/index'); ?>
        </div>
        </div>
        <div style="float: left; width: 30%; border: 1px solid #ccc;">
        <?php echo link_to(image_tag('/images/iconos/diario.png'),'diario/list?fecha='.$d); ?>
        <div>
        <?php echo link_to(__('Diario'),'diario/list?fecha='.$d); ?>
        </div>
        </div>
        <div style="float: left; width: 30%; border: 1px solid #ccc;">
        <?php echo link_to(image_tag('/images/iconos/listados.png'),'listados/index'); ?>
        <div>
        <?php echo link_to(__('Notas Evaluación'),'listados/index'); ?>
        </div>
        </div>
      <?php 
      }
      ?>
     </div>
      <?php
      }
      else
      {?>
      <div style="float: left; width: 30%; border: 1px solid #ccc;">
      <?php echo link_to(image_tag('/images/iconos/reloj.png'),'hora/list'); ?>
      <div>
      <?php echo link_to(__('Horas'),'hora/list'); ?>
      </div>
      </div>
      <div style="float: left; width: 30%; border: 1px solid #ccc;">
      <?php echo link_to(image_tag('/images/iconos/perfiles.png'),'perfil/list'); ?>
      <div>
      <?php echo link_to(__('Perfiles'),'perfil/list'); ?>
      </div>
      </div>
      <div style="float: left; width: 30%; border: 1px solid #ccc;">
      <?php echo link_to(image_tag('/images/iconos/profesores.png'),'sfGuardUser/list'); ?>
      <div>
      <?php echo link_to(__('Usuarios / Profesores'),'sfGuardUser/list'); ?>
      </div>
      </div>
      <div style="float: left; width: 30%; border: 1px solid #ccc;">
      <?php echo link_to(image_tag('/images/iconos/grupos.png'),'grupo/list'); ?>
      <div>
      <?php echo link_to(__('Grupos'),'grupo/list'); ?>
      </div>
      </div>
      <div style="float: left; width: 30%; border: 1px solid #ccc;">
      <?php echo link_to(image_tag('/images/iconos/alumnos.png'),'alumno/index'); ?>
      <div>
      <?php echo link_to(__('Alumnos'),'alumno/index'); ?>
      </div>
      </div>
      <div style="float: left; width: 30%; border: 1px solid #ccc;">
      <?php echo link_to(image_tag('/images/iconos/asignaturas.png'),'evaluacion/list'); ?>
      <div>
      <?php echo link_to(__('Evaluaciones'),'evaluacion/list'); ?>
      </div>
      </div>      
      <div style="float: left; width: 30%; border: 1px solid #ccc;">
      <?php echo link_to(image_tag('/images/iconos/festivo.png'),'festivo/index?fecha='.$d); ?>
      <div>
      <?php echo link_to(__('Festivos'),'festivo/index?fecha='.$d); ?>
      </div>
      </div>
      <?php 
      }
      ?>
    </div>
  </div>	  
</div>