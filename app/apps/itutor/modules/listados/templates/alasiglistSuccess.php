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
<?php
foreach ($alumnos as $alumno):
    $var = "im".$alumno->getId();
    echo javascript_tag("
    function imagen".$alumno->getId()."(ver) {
       document.getElementById('".$var."').style.visibility = ver;
       }
        ");
endforeach;
?>
<div id="contenedor">
<div id="titulo">
<h1><?php echo __('Listado del grupo') ?> <?php echo $grupo->getNombre(); ?> <?php echo __('en la asignatura') ?> <?php echo $asignatura->getNombre(); ?>
<div class="imprimir" style="float: right; font-size: 9pt; font-weight: normal;">
   <?php echo link_to_function(__('Imprimir'), "imprimir()"); ?>
</div>
</h1>
<h2><?php echo $evaluacion->getTitulo(); ?></h2>
</div>
<div id="listado">
<div id="warning"></div>
<table cellspacing="0">
<thead>
<tr>
  <th><?php echo __('Alumno') ?></th>
  <?php
  //Contar cuantos lunes, martes, .... hay desde el comienzo de la evaluacion hasta el final
  $lunes = 0;
  $martes = 0;
  $miercoles = 0;
  $jueves = 0;
  $viernes = 0;
  for($x = strtotime($evaluacion->getFechaini()); $x <= strtotime($evaluacion->getFechafin()); $x = strtotime("+1 day",$x))
  {
    $fecha = getdate($x);
    $dia = $fecha['wday'];
    switch ($dia)
    {   
      case 1:
          $lunes++;
          break;
      case 2:
          $martes++;
          break;
      case 3:
          $miercoles++;
          break;
      case 4:
          $jueves++;
          break;
      case 5:
          $viernes++;
          break;
     }
  }  
  //Termina el recuento de la evaluacion  
  
  //Restar el número de días festivos
        foreach ($festivos as $festivo):
          $fecha = getdate(strtotime($festivo->getFecha())); 
          $dia = $fecha['wday'];
          switch ($dia)
          {   
            case 1:
              $lunes--;
              break;
            case 2:
              $martes--;
              break;
            case 3:
              $miercoles--;
              break;
            case 4:
              $jueves--;
              break;
            case 5:
              $viernes--;
              break;
           }
        endforeach; //festivos
        //Termina resto de días festivos

    
  //Sacar las pruebas realizadas
  $pruebas_realizadas = array();
  foreach ($notasprueba as $notaprueba):
    for($x=0;$x<count($pruebas_realizadas) && $pruebas_realizadas[$x] != $notaprueba->getPruebaId();$x++);
    if($x == count($pruebas_realizadas))
    {
      $pruebas_realizadas[$x] = $notaprueba->getPruebaId();
    }
  endforeach; //notasprueba
  //Termina sacar las pruebas realizadas
  foreach ($pruebas as $prueba):
   foreach ($pruebas_realizadas as $notaprueba): 
     if($notaprueba == $prueba->getId())
     {?>
    <th>
   <?php
     if ($prueba->getObservaciones() != "")
     {
         $nombre_prueba = $prueba->getObservaciones();
     }
     else
     {
         $nombre_prueba = __('Prueba');
     }
   ?>
   <?php echo $nombre_prueba; ?> <br /> <?php echo date('d-m-Y',strtotime($prueba->getFecha()));  ?><br />(<?php echo $prueba->getPorcentaje()?>%)</th>
  <?php
     }
    endforeach;//pruebas_realizadas 
  endforeach;//prueba 
  ?> 
  <th><?php echo __('Media pruebas') ?><br />(<?php echo $asignatura->getPorcentajepruebas()?>%)</th>
  <th><?php echo __('Nota faltas') ?><br />(<?php echo $asignatura->getPorcentajefaltas()?>%)</th> 
  <th><?php echo __('Nota comportamiento') ?><br />(<?php echo $asignatura->getPorcentajecomportamiento()?>%)</th>
  <th><?php echo __('Nota media') ?><br />(100%)</th>
  <th><?php echo __('Nota media ') ?><br />(Modif.)</th>
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
<tr class="<?php echo $fila ?>"> 
      <?php
      $vis = "imagen".$alumno->getId()."('visible')";
      $oc = "imagen".$alumno->getId()."('hidden')";
      ?>
      <td class="alum"><img class="foto_alum" src="/images/iconos/camera_small.png" onmouseover="<?php echo $vis; ?>" onmouseout="<?php echo $oc; ?>" /><?php echo $alumno->getNombre() ?>
       <div id="im<?php echo $alumno->getId();?>" style="visibility:hidden;position:absolute;">
           <?php $ruta="/images/grupos/".$alumno->getGrupoId()."/".$alumno->getId().".jpg";?>
           <img src="<?php echo $ruta?>" />
       </div>
      </td>
      <?php
      $total = 0;
      $cont_total = 0;
      
        //Contar cuantas horas hay cada día de esa asignatura
        $horas_lunes = 0;
        $horas_martes = 0;
        $horas_miercoles = 0;
        $horas_jueves = 0;
        $horas_viernes = 0;
        foreach ($horarios as $horario):
         switch ($horario->getDia())
          {
            case 1:
              $horas_lunes++;
              break;
            case 2:
              $horas_martes++;
              break;
            case 3:
              $horas_miercoles++;
              break;
            case 4:
              $horas_jueves++;
              break;
            case 5:
              $horas_viernes++;
              break;      
          }    
        endforeach; //horarios 
        //Termina el recuento de horas de cada día en esa asignatura
                
        $total_horas = ($lunes * $horas_lunes) + ($martes * $horas_martes) + ($miercoles * $horas_miercoles) + ($jueves * $horas_jueves) + ($viernes * $horas_viernes);
        

        //Contar el total de faltas sin justificar de la evaluación por cada asignatura y alumno 
        $faltas_alumno = 0;
        foreach ($faltas as $falta):
          if ($falta->getAlumnoId() == $alumno->getId() && $falta->getJustificado() == false)
          {
             $faltas_alumno++;
          } 
        endforeach; //faltas 
        //Termina recuento de faltas
        
        //Calcular la nota de faltas
        $maximo = $asignatura->getMaximofaltas();
        $horas_maximas = round(($total_horas * $maximo)/100);
        
        $evaluado = true;
        
        if ($faltas_alumno > $horas_maximas)
        {
          $evaluado = false;  
          $nota_faltas = 10;      
        }
        else
        {
          $nota_faltas = ($faltas_alumno * 10)/$horas_maximas; 
        }  
        //Termina el calculo de la nota de faltas
      
      //Comprobación de porcentajes 
      $porcentaje_cien = false;
      $porcentaje = false;
      $suma_porcentajes = 0;
      $error = 0;
      foreach($pruebas as $prueba):
       if($asignatura->getId() == $prueba->getAsignaturaId())
        {
         if ($prueba->getPorcentaje() != 100)
         {
           $suma_porcentajes = $suma_porcentajes + $prueba->getPorcentaje();
           $porcentaje = true;
         }
         else
         {
           $porcentaje_cien = true;         
         } 
        }  
      endforeach; //pruebas 
      if ($porcentaje_cien == true && $porcentaje == true)
      {
        echo javascript_tag (remote_function(array(
          'update' => 'warning',
          'url' => 'principal/warning?error=1'
          )));//No puede haber porcentajes de 100 y de menos de 100 (redireccionar a pagina de error)     
      }
      else if ($porcentaje == true && $suma_porcentajes != 100)
      {
        echo javascript_tag (remote_function(array(
          'update' => 'warning',
          'url' => 'principal/warning?error=2'
          )));//Si sin porcentajes menores de 100 la suma tiene que ser 100 (redireccionar a pagina de error)
      } 
      //Sale de comprobación de porcentajes     
      $cont_prueba = 0;
      $suma_prueba = 0; 
      foreach ($pruebas as $prueba):
       
        $porcen_prueba = $prueba->getPorcentaje();
        foreach ($notasprueba as $notaprueba):
          if ($notaprueba->getAlumnoId() == $alumno->getId() && $notaprueba->getPruebaId() == $prueba->getId())
          {
            if($notaprueba->getNota())
             {
              $nota = $notaprueba->getNota();
              ?>
              <td><?php echo $notaprueba->getNota()?></td>
              <?php
             }
             else 
             {
             ?>
              <td><?php echo number_format(0,2,',','.'); ?></td>
             <?php 
                $nota = 0;
             }  
            if($porcentaje_cien == true)
            {
              $suma_prueba = $suma_prueba + $nota;
              $cont_prueba = $cont_prueba + 1;
            } 
            else 
            {
                $suma_prueba = $suma_prueba + (($nota * $porcen_prueba)/100);
            }
          } 
        endforeach; //notasprueba 
        
        if ($porcentaje_cien == true)
        {
         if($cont_prueba != 0)
         {
          $media =  $suma_prueba/$cont_prueba;
         }
         else
         {
          $media = 0;
         }
        }
        else
        { 
        $media = $suma_prueba;        
        }
        ?>
        <?php
      endforeach; //pruebas 
      
      if (count($pruebas) == 0)
      {
        $media = 0;      
      }
      //Sacar la nota del comportamiento
      $nota_comportamiento = 0;
      foreach ($comportamientos as $comportamiento):
        if($alumno->getId() == $comportamiento->getAlumnoId() && $asignatura->getId() == $comportamiento->getAsignaturaId())
        {
          $nota_comportamiento = $comportamiento->getNota();
        }   
      endforeach; //comportamiento
      //Termina calculo de la nota de comportamiento
      $media_pruebas = ($media * $asignatura->getPorcentajepruebas())/100;
      $media_faltas = (($asignatura->getPorcentajefaltas() * 10)/100) - (($nota_faltas * $asignatura->getPorcentajefaltas())/100);
      $media_comportamiento = ($nota_comportamiento * $asignatura->getPorcentajecomportamiento())/100;
      $media_asignatura = $media_pruebas + $media_faltas + $media_comportamiento;
      $total = $total + $media_asignatura;
      $cont_total++;
      ?>
      <td><?php echo number_format($media_pruebas,2,',','.'); ?></td>
      <td><?php echo number_format($media_faltas,2,',','.'); ?></td>
      <td><?php echo number_format($media_comportamiento,2,',','.'); ?></td>
      <td><?php 
      if ($evaluado == false)
      {
        echo __('superado faltas - ');      
      }      
      echo number_format($media_asignatura,2,',','.'); ?></td>
      <td><?php
      $nomform = 'formulario'.$alumno->getId();
      
      echo form_tag('listados/guardarnota', 'name='.$nomform);

      echo input_hidden_tag('alumno',$alumno->getId());
      echo input_hidden_tag('evaluacion',$evaluacion->getId());
      echo input_hidden_tag('asignatura',$asignatura->getId());
      echo input_hidden_tag('grupo',$grupo->getId());

      $esta = false;
      foreach ($notasev as $notaev):
          if ($notaev->getAlumnoId() == $alumno->getId())
          {
            $nom = 'notamod'.$alumno->getId();
            echo input_tag($nom,number_format($notaev->getNota(),2,',','.'),'size=5 class="'.$fila.'"');
            $esta = true;
          }
      endforeach;
      if ($esta == false)
      {
          $nom = 'notamod'.$alumno->getId();
          echo input_tag($nom,'','size=5 class="'.$fila.'"');
      }
      ?>
      <?php
      echo submit_tag('Guardar','class= guarda_nota');
      ?>
      </form>
      </td>

       
</tr>
<?php
$x++; 
endforeach; //alumno 
?>
</tbody>
</table>

<div id="linea"></div>
<div class="exit">
<?php 
echo link_to(__('Volver'), 'listados/index'); 
?>
</div>
</div>
</div>
