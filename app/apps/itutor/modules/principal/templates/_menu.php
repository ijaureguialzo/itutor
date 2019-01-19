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
      <?php
      echo "<ul>";
      if (!$sf_user->isSuperAdmin() && $admin == false)
      {
 
	    echo "<li>";
	    echo link_to(__('Asignaturas'),'asignatura/list'); 
	    echo "</li><li>|</li><li>";
	    echo link_to(__('Horario'),'horario/completo');
	    echo "</li>";
	    if ($grupo)
	    {
	      echo "<li>|</li>";
	      echo "<li>";
	      echo link_to(__('Alumnos'),'alumno/index?grupo_id='.$grupo->getId());
	      echo "</li>";
	    }
	    $d = strtotime("now");
	    if ($sf_user->getAttribute('asignaturas') == true && $sf_user->getAttribute('horario') == true)
	    {
        echo "<li>|</li>";
        echo "<li>";
        echo link_to(__('Faltas'),'falta/index?fecha='.$d);
        echo "</li>";
        echo "<li>|</li>";
        echo "<li>";
        echo link_to(__('Pruebas'),'prueba/index?fecha='.$d);
        echo "</li>";
        echo "<li>|</li>";
        echo "<li>";
        echo link_to(__('Comportamiento'),'comportamiento/index');
        echo "</li>";
        echo "<li>|</li>";
        echo "<li>";
        echo link_to(__('Diario'),'diario/list?fecha='.$d);
        echo "</li>";
        echo "<li>|</li><li>";
        echo link_to(__('Notas Evaluación'),'listados/index');
        echo "</li>";
      }
      }
      
      if ($sf_user->isSuperAdmin() || $admin == true)
      {
        echo "<li>";
        echo link_to(__('Horas'),'hora/list');
        echo "</li><li>|</li><li>";
        echo link_to(__('Perfiles'),'perfil/list');
        echo "</li><li>|</li><li>";
        echo link_to(__('Usuarios / Profesores'),'sfGuardUser/list');
        echo "</li><li>|</li><li>";
        echo link_to(__('Grupos'),'grupo/list');
        echo "</li><li>|</li><li>";
        echo link_to(__('Alumnos'),'alumno/index');
        echo "</li><li>|</li><li>";       
        echo link_to(__('Evaluaciones'),'evaluacion/list');
        echo "</li><li>|</li><li>";
        $d = strtotime("now");
        echo link_to(__('Festivos'),'festivo/index?fecha='.$d);
        echo "</li><li>|</li><li>";
        echo link_to(__('Grupos-Evaluaciones'),'grupoevaluacion/list');
        echo "</li>";
      }
      echo "</ul>";
      ?> 

