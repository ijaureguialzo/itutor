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

/**
 * listados actions.
 *
 * @package    gesal
 * @subpackage listados
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class listadosActions extends sfActions
{
  /**
   * Executes index action
   *
   */
   public function executeIndex()
  {
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));
    
    $this->profesor = ProfesorPeer::doSelectOne($d);

    $this->c = new Criteria();
    $this->c->addJoin(HorarioPeer::GRUPO_ID, GrupoPeer::ID);
    $this->c->add(HorarioPeer::PROFESOR_ID, $this->profesor->getId());
    $this->c->addAscendingOrderByColumn(GrupoPeer::NOMBRE);
   
    
    $this->d = new Criteria();
    $this->d->addJoin(HorarioPeer::ASIGNATURA_ID,AsignaturaPeer::ID);
    $this->d->add(HorarioPeer::PROFESOR_ID, $this->profesor->getId());
    $this->d->addAscendingOrderByColumn(AsignaturaPeer::NOMBRE);
    
  }

  public function executeGrupoev()
  {
    $fecha = strtotime("now");

    $c = new Criteria();
    $c->add(EvaluacionPeer::FECHAINI,$fecha,Criteria::LESS_EQUAL);
    $c->add(EvaluacionPeer::FECHAFIN,$fecha,Criteria::GREATER_EQUAL);
    $c->add(GrupoevaluacionPeer::GRUPO_ID, $this->getRequestParameter('grupo_id'));
    $c->addJoin(EvaluacionPeer::ID,GrupoevaluacionPeer::EVALUACION_ID);
    $this->eva_actual = EvaluacionPeer::doSelectOne($c);

    $this->a = new Criteria();
    $this->a->add(GrupoevaluacionPeer::GRUPO_ID, $this->getRequestParameter('grupo_id'));
    $this->a->addJoin(EvaluacionPeer::ID,GrupoevaluacionPeer::EVALUACION_ID);
 
  }
  
  public function executeAlasiglist()
  {
  if (!$this->getRequestParameter('grupo_id') || !$this->getRequestParameter('asignatura_id'))
   {
      $mensaje = 'No se puede visualizar el listado sin grupo o asignatura asociada.';     
      return $this->redirect('principal/error?mensaje='.$mensaje);
   }
   else
   {
   $c= new Criteria();
   $c->add(ProfesorPeer::CODIGO, $this->getUser()->getAttribute('codigo'));
   $this->profesor = ProfesorPeer::doSelectOne($c);
   
   $this->asignatura = AsignaturaPeer::retrieveByPk($this->getRequestParameter('asignatura_id'));
   $this->grupo = GrupoPeer::retrieveByPk($this->getRequestParameter('grupo_id'));
   $this->evaluacion = EvaluacionPeer::retrieveByPk($this->getRequestParameter('evaluacion_id'));
   
   $c = new Criteria();
   $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo_id'));
   $c->addAscendingOrderByColumn(AlumnoPeer::NOMBRE);
   $this->alumnos = AlumnoPeer::doSelect($c);
           
   $c = new Criteria();
   $c->add(FaltaPeer::EVALUACION_ID, $this->evaluacion->getId());
   $c->add(FaltaPeer::ASIGNATURA_ID, $this->asignatura->getId());
   $this->faltas = FaltaPeer::doSelect ($c);
   
   $c = new Criteria();
   $c->add(ComportamientoPeer::EVALUACION_ID,$this->evaluacion->getId());
   $c->add(ComportamientoPeer::ASIGNATURA_ID,$this->asignatura->getId());
   $this->comportamientos = ComportamientoPeer::doSelect($c);
   
   $c = new Criteria();
   $c->add(PruebaPeer::EVALUACION_ID,$this->evaluacion->getId());
   $c->add(PruebaPeer::ASIGNATURA_ID,$this->asignatura->getId());
   
   //Esto luego habría que quitar; solución provisional...
   $f = new Criteria();
   $f->add(PruebaPeer::GRUPO_ID,$this->grupo->getId());
   $prue_interm = PruebaPeer::doSelect($f);
   
   if ($prue_interm)
   { 
       $c->add(PruebaPeer::GRUPO_ID,$this->grupo->getId());
   }
   
   
   $c->addJoin(PruebaPeer::ASIGNATURA_ID,AsignaturaPeer::ID);
   $c->addJoin(AsignaturaPeer::ID,HorarioPeer::ASIGNATURA_ID);
   $c->add(HorarioPeer::GRUPO_ID,$this->grupo->getId());
   
   $c->setDistinct();
   $this->pruebas = PruebaPeer::doSelect($c);
   
   $c = new Criteria();
   $c->add(FestivoPeer::EVALUACION_ID,$this->evaluacion->getId());
   $this->festivos = FestivoPeer::doSelect($c);
   
   $c = new Criteria();
   $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
   $c->add(HorarioPeer::ASIGNATURA_ID,$this->asignatura->getId());
   $c->add(HorarioPeer::GRUPO_ID,$this->grupo->getId()); 
   
   $this->horarios = HorarioPeer::doSelect($c);
     
   $this->notasprueba = NotapruebaPeer::doSelect(new Criteria());

   $c = new Criteria();
   $c->add(NotaevaluacionPeer::EVALUACION_ID,$this->getRequestParameter('evaluacion_id'));
   $c->add(NotaevaluacionPeer::ASIGNATURA_ID,$this->getRequestParameter('asignatura_id'));
   $c->addJoin(NotaevaluacionPeer::ALUMNO_ID,AlumnoPeer::ID);
   $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo_id'));

   $this->notasev = NotaevaluacionPeer::doSelect($c);
   }
  }

  public function executeGuardarnota()
  {
      $alumno = $this->getRequestParameter('alumno');
      $evaluacion = $this->getRequestParameter('evaluacion');
      $asignatura = $this->getRequestParameter('asignatura');
      $grupo = $this->getRequestParameter('grupo');

      $c = new Criteria();
      $c->add(NotaevaluacionPeer::ALUMNO_ID,$alumno);
      $c->add(NotaevaluacionPeer::EVALUACION_ID,$evaluacion);
      $c->add(NotaevaluacionPeer::ASIGNATURA_ID,$asignatura);

      $nota = NotaevaluacionPeer::doSelectOne($c);

      $notamod = $this->getRequestParameter('notamod'.$alumno);

      $notamod = str_replace(",",".",$notamod);

      if (!$nota)
      {
         $nota = new Notaevaluacion();
         
         $nota->setAlumnoId($alumno);
         $nota->setEvaluacionId($evaluacion);
         $nota->setAsignaturaId($asignatura);
      }
      $nota->setNota($notamod);
      $nota->save();

      
      return $this->redirect('listados/alasiglist?asignatura_id='.$asignatura.'&evaluacion_id='.$evaluacion.'&grupo_id='.$grupo);
  }
  public function executeGrupoasiglist()
  {
  if (!$this->getRequestParameter('asignatura_id'))
   {
      $mensaje = 'No se puede visualizar el listado asignatura asociada.';     
      return $this->redirect('principal/error?mensaje='.$mensaje);
   }
   else
   {
   $c= new Criteria();
   $c->add(ProfesorPeer::CODIGO, $this->getUser()->getAttribute('codigo'));
   $this->profesor = ProfesorPeer::doSelectOne($c);
   
   $this->asignatura = AsignaturaPeer::retrieveByPk($this->getRequestParameter('asignatura_id'));
   
   $this->c = new Criteria();
   $this->c->addJoin(HorarioPeer::GRUPO_ID, GrupoPeer::ID);
   $this->c->add(HorarioPeer::PROFESOR_ID, $this->profesor->getId());
   $this->c->add(HorarioPeer::ASIGNATURA_ID, $this->getRequestParameter('asignatura_id'));
   
   $fecha = strtotime("now");
    
    $c = new Criteria();
    $c->add(EvaluacionPeer::FECHAINI,$fecha,Criteria::LESS_EQUAL);
    $c->add(EvaluacionPeer::FECHAFIN,$fecha,Criteria::GREATER_EQUAL);
    $this->eva_actual = EvaluacionPeer::doSelectOne($c);

    $this->a = new Criteria();
    $this->a->add(HorarioPeer::ASIGNATURA_ID, $this->getRequestParameter('asignatura_id'));
    $this->a->addJoin(HorarioPeer::GRUPO_ID,GrupoPeer::ID);
    $this->a->addJoin(GrupoevaluacionPeer::GRUPO_ID, GrupoPeer::ID);
    $this->a->addJoin(EvaluacionPeer::ID,GrupoevaluacionPeer::EVALUACION_ID);
    
   
   }
  }
  
  public function executeGrupoasigresumenlist()
  {
   if (!$this->getRequestParameter('asignatura_id'))
   {
      $mensaje = 'No se puede visualizar el listado asignatura asociada.';     
      return $this->redirect('principal/error?mensaje='.$mensaje);
   }
   else
   {
   $c= new Criteria();
   $c->add(ProfesorPeer::CODIGO, $this->getUser()->getAttribute('codigo'));
   $this->profesor = ProfesorPeer::doSelectOne($c);
   
   $this->asignatura = AsignaturaPeer::retrieveByPk($this->getRequestParameter('asignatura_id'));
   
   $this->c = new Criteria();
   $this->c->addJoin(HorarioPeer::GRUPO_ID, GrupoPeer::ID);
   $this->c->add(HorarioPeer::PROFESOR_ID, $this->profesor->getId());
   $this->c->add(HorarioPeer::ASIGNATURA_ID, $this->getRequestParameter('asignatura_id'));
    
   }
  }
  
  public function executeAlresumenlist()
  {
  if (!$this->getRequestParameter('grupo_id') || !$this->getRequestParameter('asignatura_id'))
   {
      $mensaje = 'No se puede visualizar el listado sin grupo o asignatura asociada.';      
      return $this->redirect('principal/error?mensaje='.$mensaje);
   }
   else
   {
   $c= new Criteria();
   $c->add(ProfesorPeer::CODIGO, $this->getUser()->getAttribute('codigo'));
   $this->profesor = ProfesorPeer::doSelectOne($c);
   
   $this->asignatura = AsignaturaPeer::retrieveByPk($this->getRequestParameter('asignatura_id'));
   $this->grupo = GrupoPeer::retrieveByPk($this->getRequestParameter('grupo_id'));
   
   $c = new Criteria();
   $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo_id'));
   $c->addAscendingOrderByColumn(AlumnoPeer::NOMBRE);
   $this->alumnos = AlumnoPeer::doSelect($c);
           
   $c = new Criteria();
   $c->add(FaltaPeer::ASIGNATURA_ID, $this->asignatura->getId());
   $this->faltas = FaltaPeer::doSelect ($c);
   
   $c = new Criteria();
   $c->add(ComportamientoPeer::ASIGNATURA_ID,$this->asignatura->getId());
   $this->comportamientos = ComportamientoPeer::doSelect($c);
   
   $c = new Criteria();
   $c->add(PruebaPeer::ASIGNATURA_ID,$this->asignatura->getId());
   $c->addJoin(PruebaPeer::ASIGNATURA_ID,AsignaturaPeer::ID);
   $c->addJoin(AsignaturaPeer::ID,HorarioPeer::ASIGNATURA_ID);
   $c->add(HorarioPeer::GRUPO_ID,$this->grupo->getId());
   
   $c->setDistinct();
   $this->pruebas = PruebaPeer::doSelect($c);
   
   $c = new Criteria();
   $this->festivos = FestivoPeer::doSelect($c);
   
   $c = new Criteria();
   $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
   $c->add(HorarioPeer::ASIGNATURA_ID,$this->asignatura->getId());
   $c->add(HorarioPeer::GRUPO_ID,$this->grupo->getId()); 
   
   $this->horarios = HorarioPeer::doSelect($c);
     
   $this->notasprueba = NotapruebaPeer::doSelect(new Criteria());

   $this->a = new Criteria();
    $this->a->add(GrupoevaluacionPeer::GRUPO_ID, $this->grupo->getId());
    $this->a->addJoin(EvaluacionPeer::ID,GrupoevaluacionPeer::EVALUACION_ID);
   $this->evaluaciones = EvaluacionPeer::doSelect($this->a);

   $c = new Criteria();
   $c->addJoin(NotaevaluacionPeer::EVALUACION_ID,EvaluacionPeer::ID);
   $c->add(NotaevaluacionPeer::ASIGNATURA_ID,$this->asignatura->getId());
   $c->addJoin(NotaevaluacionPeer::ALUMNO_ID,AlumnoPeer::ID);
   $c->add(AlumnoPeer::GRUPO_ID,$this->grupo->getId());

   $this->notasev = NotaevaluacionPeer::doSelect($c);
   }
  }

/* PRUEBA */

  public function executeAlresumenlistpdf()
  {
  if (!$this->getRequestParameter('grupo_id') || !$this->getRequestParameter('asignatura_id'))
   {
      $mensaje = 'No se puede visualizar el listado sin grupo o asignatura asociada.';      
      return $this->redirect('principal/error?mensaje='.$mensaje);
   }
   else
   {
   $c= new Criteria();
   $c->add(ProfesorPeer::CODIGO, $this->getUser()->getAttribute('codigo'));
   $this->profesor = ProfesorPeer::doSelectOne($c);
   
   $this->asignatura = AsignaturaPeer::retrieveByPk($this->getRequestParameter('asignatura_id'));
   $this->grupo = GrupoPeer::retrieveByPk($this->getRequestParameter('grupo_id'));
   
   $c = new Criteria();
   $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo_id'));
   $c->addAscendingOrderByColumn(AlumnoPeer::NOMBRE);
   $this->alumnos = AlumnoPeer::doSelect($c);
           
   $c = new Criteria();
   $c->add(FaltaPeer::ASIGNATURA_ID, $this->asignatura->getId());
   $this->faltas = FaltaPeer::doSelect ($c);
   
   $c = new Criteria();
   $c->add(ComportamientoPeer::ASIGNATURA_ID,$this->asignatura->getId());
   $this->comportamientos = ComportamientoPeer::doSelect($c);
   
   $c = new Criteria();
   $c->add(PruebaPeer::ASIGNATURA_ID,$this->asignatura->getId());
   $c->addJoin(PruebaPeer::ASIGNATURA_ID,AsignaturaPeer::ID);
   $c->addJoin(AsignaturaPeer::ID,HorarioPeer::ASIGNATURA_ID);
   $c->add(HorarioPeer::GRUPO_ID,$this->grupo->getId());
   
   $c->setDistinct();
   $this->pruebas = PruebaPeer::doSelect($c);
   
   $c = new Criteria();
   $this->festivos = FestivoPeer::doSelect($c);
   
   $c = new Criteria();
   $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
   $c->add(HorarioPeer::ASIGNATURA_ID,$this->asignatura->getId());
   $c->add(HorarioPeer::GRUPO_ID,$this->grupo->getId()); 
   
   $this->horarios = HorarioPeer::doSelect($c);
     
   $this->notasprueba = NotapruebaPeer::doSelect(new Criteria());
   $this->evaluaciones = EvaluacionPeer::doSelect(new Criteria());
   }
   
       require_once(sfConfig::get('sf_tcpdf_dir').'/config/lang/eng.php');
    
    $doc_title = "test title";
    $doc_subject = "test description";
    $doc_keywords = "test keywords";
    $htmlcontent = "&lt; € &euro; &#8364; &amp; è &egrave; &copy; &gt;<br /><h1>heading 1</h1><h2>heading 2</h2><h3>heading 3</h3><h4>heading 4</h4><h5>heading 5</h5><h6>heading 6</h6>ordered list:<br /><ol><li><b>bold text</b></li><li><i>italic text</i></li><li><u>underlined text</u></li><li><a href=\"http://www.tecnick.com\">link to http://www.tecnick.com</a></li><li>test break<br />second line<br />third line</li><li><font size=\"+3\">font + 3</font></li><li><small>small text</small></li><li>normal <sub>subscript</sub> <sup>superscript</sup></li></ul><hr />table:<br /><table border=\"1\" cellspacing=\"1\" cellpadding=\"1\"><tr><th>#</th><th>A</th><th>B</th></tr><tr><th>1</th><td bgcolor=\"#cccccc\">A1</td><td>B1</td></tr><tr><th>2</th><td>A2 € &euro; &#8364; &amp; è &egrave; </td><td>B2</td></tr><tr><th>3</th><td>A3</td><td><font color=\"#FF0000\">B3</font></td></tr></table><hr />image:<br /><img src=\"sfTCPDFPlugin/images/logo_example.png\" alt=\"test alt attribute\" width=\"100\" height=\"100\" border=\"0\" />";

    //create new PDF document (document units are set by default to millimeters)
    $pdf = new sfTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true);

    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor(PDF_AUTHOR);
    $pdf->SetTitle($doc_title);
    $pdf->SetSubject($doc_subject);
    $pdf->SetKeywords($doc_keywords);

    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    //set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    //set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); //set image scale factor

    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->setLanguageArray($l); //set language items

    //initialize document
    $pdf->AliasNbPages();
    $pdf->AddPage();


$h = 'Listado del grupo'.$grupo->getNombre().'en la asignatura'.$asignatura->getNombre().'</h1>';
/*
<table cellspacing="0">
<thead>
<tr>
  <th><?php echo __('Alumno') ?></th>
  <?php
  foreach ($evaluaciones as $evaluacion):?>
    <th><?php echo $evaluacion->getTitulo() ?></th>
  <?php
  endforeach;
  ?>
  <th><?php echo __('Nota media') ?></th>
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
      <td><?php echo $alumno->getNombre() ?></td> 
  <?php
  $total = 0;
  foreach ($evaluaciones as $evaluacion):
  $media = 0;  
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
        
        //Restar el número de días festivos
        foreach ($festivos as $festivo):
         if($festivo->getEvaluacionId() == $evaluacion->getId())
         {
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
          }
        endforeach; //festivos
        //Termina resto de días festivos
        
        $total_horas = ($lunes * $horas_lunes) + ($martes * $horas_martes) + ($miercoles * $horas_miercoles) + ($jueves * $horas_jueves) + ($viernes * $horas_viernes);
        

        //Contar el total de faltas sin justificar de la evaluación por cada asignatura y alumno 
        $faltas_alumno = 0;
        foreach ($faltas as $falta):
          if ($falta->getAlumnoId() == $alumno->getId() && $falta->getJustificado() == false && $falta->getEvaluacionId() == $evaluacion->getId())
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
       if($asignatura->getId() == $prueba->getAsignaturaId() && $prueba->getEvaluacionId() == $evaluacion->getId())
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
       if ($prueba->getEvaluacionId() == $evaluacion->getId())
       {
        $porcen_prueba = $prueba->getPorcentaje();
        foreach ($notasprueba as $notaprueba):
          if ($notaprueba->getAlumnoId() == $alumno->getId() && $notaprueba->getPruebaId() == $prueba->getId())
          {
            if($notaprueba->getNota())
             {
              $nota = $notaprueba->getNota();
             }
             else 
             {
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
       }
      endforeach; //pruebas 
      
      if (count($pruebas) == 0)
      {
        $media = 0;      
      }
      //Sacar la nota del comportamiento
      $nota_comportamiento = 0;
      foreach ($comportamientos as $comportamiento):
        if($alumno->getId() == $comportamiento->getAlumnoId() && $asignatura->getId() == $comportamiento->getAsignaturaId() && $comportamiento->getEvaluacionId() == $evaluacion->getId())
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
      ?>
      <td><?php 
      if ($evaluado == false)
      {
        echo __('superado faltas - ');      
      }      
      echo number_format($media_asignatura,2,',','.'); ?></td>
<?php 
endforeach; //evaluaciones
$cont_total = count($evaluaciones); 
?> 
<td>
<?php 
echo number_format($total/$cont_total,2,',','.'); ?></td>     
</tr>
<?php 
$x++; 
endforeach; //alumno 
?>
</tbody>
</table>

*/


    // output some HTML code
    $pdf->writeHTML($h, true, 0);

    //Close and output PDF document
    $pdf->Output();

    return sfView::NONE;
  }

/* PRUEBA */

  public function executeAlgrupolist()
  {
  
   if (!$this->getRequestParameter('grupo_id'))
   {
      $mensaje = 'No se puede visualizar el listado sin grupo asociado.';     
      return $this->redirect('principal/error?mensaje='.$mensaje);
   }
   else
   {
   $c= new Criteria();
   $c->add(ProfesorPeer::CODIGO, $this->getUser()->getAttribute('codigo'));
   $this->profesor = ProfesorPeer::doSelectOne($c);
   
   $c = new Criteria();
   $c->add(HorarioPeer::GRUPO_ID,$this->getRequestParameter('grupo_id'));
   $this->horarios = HorarioPeer::doSelect($c);
   
   $c = new Criteria();
   $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo_id'));
   $c->addAscendingOrderByColumn(AlumnoPeer::NOMBRE);
   $this->alumnos = AlumnoPeer::doSelect($c);
   
   $d = new Criteria();
   $d->add(HorarioPeer::GRUPO_ID,$this->getRequestParameter('grupo_id'));
   $d->addJoin(HorarioPeer::ASIGNATURA_ID,AsignaturaPeer::ID);
   $d->setDistinct();
   $this->asignaturas = AsignaturaPeer::doSelect($d);
   
   $this->evaluacion = EvaluacionPeer::retrieveByPk ($this->getRequestParameter('evaluacion_id'));
   
   $c = new Criteria();
   $c->add(FaltaPeer::EVALUACION_ID, $this->evaluacion->getId());
   $c->addJoin(FaltaPeer::ALUMNO_ID,AlumnoPeer::ID);
   $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo_id'));
   $this->faltas = FaltaPeer::doSelect ($c);
   
   $c = new Criteria();
   $c->add(ComportamientoPeer::EVALUACION_ID,$this->evaluacion->getId());
   $c->addJoin(ComportamientoPeer::ALUMNO_ID,AlumnoPeer::ID);
   $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo_id'));
   $this->comportamientos = ComportamientoPeer::doSelect($c);
   
   $c = new Criteria();
   $c->add(PruebaPeer::EVALUACION_ID,$this->evaluacion->getId());
   $this->pruebas = PruebaPeer::doSelect($c);
   
   $c = new Criteria();
   $c->add(FestivoPeer::EVALUACION_ID,$this->evaluacion->getId());
   $this->festivos = FestivoPeer::doSelect($c);
   
   $this->notasprueba = NotapruebaPeer::doSelect(new Criteria());
   $this->grupo = GrupoPeer::retrieveByPk($this->getRequestParameter('grupo_id'));

   $c = new Criteria();
   $c->add(NotaevaluacionPeer::EVALUACION_ID,$this->getRequestParameter('evaluacion_id'));
   $c->addJoin(NotaevaluacionPeer::ASIGNATURA_ID,HorarioPeer::ASIGNATURA_ID);
   $c->add(HorarioPeer::GRUPO_ID,$this->getRequestParameter('grupo_id'));
   $c->addJoin(NotaevaluacionPeer::ALUMNO_ID,AlumnoPeer::ID);
   $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo_id'));

   $this->notasev = NotaevaluacionPeer::doSelect($c);
   }
   
   
   
  }
}
