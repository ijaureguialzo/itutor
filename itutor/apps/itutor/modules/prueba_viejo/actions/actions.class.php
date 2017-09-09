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
// date: 2008/03/11 09:50:56
?>
<?php

/**
 * prueba actions.
 *
 * @package    gesal
 * @subpackage prueba
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class pruebaActions extends sfActions
{
   public function executeIndex()
  {
    //return $this->forward('falta', 'list');
    $c= new Criteria();
    $c->add(ProfesorPeer::CODIGO, $this->getUser()->getAttribute('codigo'));
    $this->profesor = ProfesorPeer::doSelectOne($c);
    
    $d = new Criteria();
   $d->add(HoraperfilPeer::PERFIL_ID,$this->profesor->getPerfilId());
   $d->addJoin(HoraperfilPeer::HORA_ID,HoraPeer::ID);
   $d->addAscendingOrderByColumn(HoraperfilPeer::ORDEN);
   
    $this->horas = HoraPeer::doSelect($d); 
    
    $d = new Criteria();
    $d->add(HorarioPeer::PROFESOR_ID, $this->profesor->getId());  
    $this->horarios = HorarioPeer::doSelect($d);
    
    $this->asignaturas = AsignaturaPeer::doSelect(new Criteria());
    $this->grupos = GrupoPeer::doSelect (new Criteria());
    
    $this->fecha = getdate($this->getRequestParameter('fecha'));
    
    $this->festivos = FestivoPeer::doSelect(new Criteria());
    
    
  }
  
  public function executeNuevo()
  {
  $d = new Criteria();
  $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));
    
  $this->profesor = ProfesorPeer::doSelectOne($d);
    
  $c = new Criteria();
  $c->add(PruebaPeer::ASIGNATURA_ID,$this->getRequestParameter('asignatura'));
  $c->add(PruebaPeer::DIA,$this->getRequestParameter('dia'));
  $c->add(PruebaPeer::HORA,$this->getRequestParameter('hora'));
  $fecha = date('Y-m-d',$this->getRequestParameter('fecha'));
  $c->add(PruebaPeer::FECHA,$fecha);
  
  $this->prueba = PruebaPeer::doSelectOne($c);
  
  $c = new Criteria();
  $c->add(EvaluacionPeer::FECHAINI,$fecha,Criteria::LESS_EQUAL);
  $c->add(EvaluacionPeer::FECHAFIN,$fecha,Criteria::GREATER_EQUAL);
    
  $this->evaluacion = EvaluacionPeer::doSelectOne($c);
  
  $this->evaluaciones = EvaluacionPeer::doSelect(new Criteria());
  $this->asignaturas = AsignaturaPeer::doSelect(new Criteria());
  
  $this->grupo = $this->getRequestParameter('grupo');
  $this->grupoid = $this->getRequestParameter('grupoid');
  
  $this->dia = $this->getRequestParameter('dia');
  $this->hora = $this->getRequestParameter('hora');
  
  $this->fecha = $this->getRequestParameter('fecha');
  
  $this->crear = false;
  
  if (!$this->prueba)
  {
    $this->crear = true;
    $this->prueba = new Prueba();
    $this->prueba->setDia($this->getRequestParameter('dia'));
    $this->prueba->setHora($this->getRequestParameter('hora'));
    $this->prueba->setFecha($fecha); 
    $this->prueba->setAsignaturaId($this->getRequestParameter('asignatura'));
    $this->prueba->setEvaluacionId($this->evaluacion->getId());
    
    $this->setTemplate('edit');
  }
  else
  {
    $g = new Criteria();
    $g->add(PruebaPeer::DIA,$this->dia);
    $g->add(PruebaPeer::HORA,$this->hora);
    $g->add(PruebaPeer::ASIGNATURA_ID,$this->getRequestParameter('asignatura'));
    $g->addAscendingOrderByColumn(PruebaPeer::ASIGNATURA_ID);
    $g->addAscendingOrderByColumn(PruebaPeer::FECHA);
    $this->pruebas = PruebaPeer::doSelect($g);
    $this->asignatura = AsignaturaPeer::retrieveByPk($this->getRequestParameter('asignatura'));
    $this->setTemplate('listado');
  }
  }

  public function executeList()
  {
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));

    $this->profesor = ProfesorPeer::doSelectOne($d);

    $f = new Criteria();
    $f->addAscendingOrderByColumn(PruebaPeer::EVALUACION_ID);
    $f->addAscendingOrderByColumn(PruebaPeer::ASIGNATURA_ID);
    $f->addAscendingOrderByColumn(PruebaPeer::FECHA);
    $f->addJoin(PruebaPeer::ASIGNATURA_ID,AsignaturaPeer::ID);
    $f->addJoin(AsignaturaPeer::PROFESOR_ID,ProfesorPeer::ID);
    $f->add(ProfesorPeer::ID,$this->profesor->getId());
    
    $this->pruebas = PruebaPeer::doSelect($f);
    
    $c = new Criteria();
    $c->add(AsignaturaPeer::PROFESOR_ID,$this->profesor->getId());
    $this->asignaturas = AsignaturaPeer::doSelect($c);
    
    $this->evaluaciones = EvaluacionPeer::doSelect(new Criteria());
    
    $c = new Criteria();
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
    $c->addGroupByColumn(HorarioPeer::ASIGNATURA_ID); 
    $c->setDistinct();
    $this->horarios = HorarioPeer::doSelect($c);
    
    $this->grupo = $this->getRequestParameter('grupo');
    $this->grupoid = $this->getRequestParameter('grupoid');
    $this->fecha = $this->getRequestParameter('fecha');
    
  }
  
  public function executeListado()
  {
        
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));
    
    $this->profesor = ProfesorPeer::doSelectOne($d);
    
    
    $this->evaluaciones = EvaluacionPeer::doSelect(new Criteria());
    
    $this->grupo = $this->getRequestParameter('grupo');
    $this->dia = $this->getRequestParameter('dia');
    $this->hora = $this->getRequestParameter('hora');
    
    $this->fecha = $this->getRequestParameter('fecha');

    $this->asignatura = AsignaturaPeer::retrieveByPk($this->getRequestParameter('asignatura'));
    
    $g = new Criteria();
    $g->add(PruebaPeer::DIA,$this->dia);
    $g->add(PruebaPeer::HORA,$this->hora);
    $g->add(PruebaPeer::ASIGNATURA_ID,$this->asignatura->getId());
    $g->addAscendingOrderByColumn(PruebaPeer::EVALUACION_ID);
    $this->pruebas = PruebaPeer::doSelect($g);
    
    $this->grupoid = $this->getRequestParameter('grupoid');
    
  }
  
   public function executeAlumnolist()
  {
  
    
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));
    
    $this->profesor = ProfesorPeer::doSelectOne($d);
    $this->prueba = PruebaPeer::retrieveByPk($this->getRequestParameter('prueba'));
    
    $this->fecha = $this->getRequestParameter('fecha');
    
    $this->grupoid = $this->getRequestParameter('grupoid');
    
    if ($this->getRequestParameter('grupo') != 0)
    {
    $d = new Criteria();
    $d->add(AlumnoPeer::GRUPO_ID, $this->getRequestParameter('grupo'));
    $d->addAscendingOrderByColumn(AlumnoPeer::NOMBRE);   
    $this->alumnos = AlumnoPeer::doSelect($d);
    
    $c = new Criteria();
    $c->add(NotapruebaPeer::PRUEBA_ID,$this->prueba->getId());
    
    $this->notas = NotapruebaPeer::doSelect($c);
    $this->grupo = GrupoPeer::retrieveByPk($this->getRequestParameter('grupo'));
    }
    else
    {
    
    $d = new Criteria();
    $d->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
    $d->add(HorarioPeer::ASIGNATURA_ID,$this->prueba->getAsignaturaId());
    $d->add(HorarioPeer::DIA,$this->prueba->getDia());
    $d->add(HorarioPeer::HORA,$this->prueba->getHora());
    
    $horario = HorarioPeer::doSelectOne($d);

    $this->grupo = GrupoPeer::retrieveByPk($horario->getGrupoId());
    
    $d = new Criteria();
    $d->add(AlumnoPeer::GRUPO_ID, $this->grupo->getId()); 
    $d->addAscendingOrderByColumn(AlumnoPeer::NOMBRE);   
    $this->alumnos = AlumnoPeer::doSelect($d);
    
    $c = new Criteria();
    $c->add(NotapruebaPeer::PRUEBA_ID,$this->prueba->getId());
    
    $this->notas = NotapruebaPeer::doSelect($c);
    
    }
    
  }
  
 public function executeNotasedit()
  {
  
    
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));
    
    $this->profesor = ProfesorPeer::doSelectOne($d);
    
    $d = new Criteria();
    $d->add(AlumnoPeer::GRUPO_ID, $this->getRequestParameter('grupo')); 
    $d->addAscendingOrderByColumn(AlumnoPeer::NOMBRE);  
    $this->alumnos = AlumnoPeer::doSelect($d);
    
    $this->prueba = PruebaPeer::retrieveByPk($this->getRequestParameter('prueba'));
    $this->fecha = $this->getRequestParameter('fecha');
    
    $c = new Criteria();
    $c->add(NotapruebaPeer::PRUEBA_ID,$this->prueba->getId());
    
    $notasprueba = NotapruebaPeer::doSelect($c);
    
    foreach ($this->alumnos as $alum):
    $encontrado = false;
     foreach($notasprueba as $nota):
      if ($nota->getPruebaId() == $this->getRequestParameter('prueba') && $nota->getAlumnoId() == $alum->getId())
      {
        $encontrado = true;
      }
     endforeach;
    endforeach;
    
    if ($encontrado == false)
    { 
      foreach ($this->alumnos as $alum):
      
      $notaprueba = new Notaprueba();
      $notaprueba->setPruebaId($this->prueba->getId());
      $notaprueba->setAlumnoId($alum->getId());
      $notaspru[$alum->getId()] = new Notaprueba();
      $notaspru[$alum->getId()] = $notaprueba;
      endforeach;
      
      $this->notas=$notaspru;
    }
    else
    {
      foreach ($notasprueba as $nota):
       if ($nota->getPruebaId() == $this->prueba->getId())
       {
         $notaspru[$nota->getAlumnoId()] = new Notaprueba();
         $notaspru[$nota->getAlumnoId()] = $nota;
       }
      endforeach; 
      $this->notas=$notaspru;
    }
 
    $this->grupoid = $this->getRequestParameter('grupoid');
    $this->grupo = GrupoPeer::retrieveByPk($this->getRequestParameter('grupo'));
    
  }

  public function executeShow()
  {
    $this->prueba = PruebaPeer::retrieveByPk($this->getRequestParameter('id'));
    
    $this->evaluaciones = EvaluacionPeer::doSelect(new Criteria());
    $this->asignaturas = AsignaturaPeer::doSelect(new Criteria());
    $this->grupoid = $this->getRequestParameter('grupoid');
    
    $this->fecha = $this->getRequestParameter('fecha');
    
    $this->forward404Unless($this->prueba);
  }

  public function executeCreate()
  {
    $this->prueba = new Prueba();
    
    if ($this->getRequestParameter('dia') != 0)
    {
    $this->prueba->setDia($this->getRequestParameter('dia'));
    $this->prueba->setHora($this->getRequestParameter('hora'));
    $this->prueba->setAsignaturaId($this->getRequestParameter('asignatura'));
    
       
    $this->grupo = $this->getRequestParameter('grupo');
    
    }
    
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));
    
    $this->profesor = ProfesorPeer::doSelectOne($d);
    
    $this->c = new Criteria();
    $this->c->add(AsignaturaPeer::PROFESOR_ID,$this->profesor->getId());
    $this->grupoid = $this->getRequestParameter('grupoid');
    
    $c = new Criteria();
    $c->add(AsignaturaPeer::PROFESOR_ID,$this->profesor->getId());
    
    $this->asignaturas = AsignaturaPeer::doSelect($c);
    
    $this->crear = true;
    
    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->prueba = PruebaPeer::retrieveByPk($this->getRequestParameter('id'));
    
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));
    
    $this->profesor = ProfesorPeer::doSelectOne($d);
    
    $c = new Criteria();
    $c->add(AsignaturaPeer::PROFESOR_ID,$this->profesor->getId());
    
    $this->asignaturas = AsignaturaPeer::doSelect($c);
    
    $this->grupoid = $this->getRequestParameter('grupoid');
    $this->fecha = $this->getRequestParameter('fecha');
    
    $c = new Criteria();
    $c->add(EvaluacionPeer::FECHAINI,$this->fecha,Criteria::LESS_EQUAL);
    $c->add(EvaluacionPeer::FECHAFIN,$this->fecha,Criteria::GREATER_EQUAL);
    
    $this->evaluacion = EvaluacionPeer::doSelectOne($c);
    
    $this->crear = $this->getRequestParameter('crear');
    if (!$this->crear)
    {
      $this->crear = false;    
    }
    $this->forward404Unless($this->prueba);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $prueba = new Prueba();
    }
    else
    {
      $prueba = PruebaPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($prueba);
    }

    $prueba->setId($this->getRequestParameter('id'));
    $prueba->setEvaluacionId($this->getRequestParameter('evaluacion_id') ? $this->getRequestParameter('evaluacion_id') : null);
    $prueba->setAsignaturaId($this->getRequestParameter('asignatura_id') ? $this->getRequestParameter('asignatura_id') : null);
    $prueba->setDia($this->getRequestParameter('dia'));
    $prueba->setHora($this->getRequestParameter('hora'));
    $prueba->setFecha($this->getRequestParameter('fecha'));
    $fecha = $prueba->getFecha();
    $prueba->setDuracion($this->getRequestParameter('duracion'));
    $prueba->setPorcentaje($this->getRequestParameter('porcentaje'));
    $prueba->setObservaciones($this->getRequestParameter('observaciones'));
    $prueba->setActivo($this->getRequestParameter('activo', 0));

    if ($this->getRequestParameter('crear'))
    {
    $c = new Criteria();
    $c->add(PruebaPeer::DIA,$this->getRequestParameter('dia'));
    $c->add(PruebaPeer::HORA,$this->getRequestParameter('hora'));
    $c->add(PruebaPeer::FECHA,$fecha);
    
    $pruebaex = PruebaPeer::doSelectOne($c);
    
    if ($pruebaex)
    {
      $mensaje = 'Ya existe una prueba en esa fecha a esa hora.';     
      return $this->redirect('principal/error?mensaje=');
    }
    else
    {
     
     $prueba->save();
 
    $this->grupoid = $this->getRequestParameter('grupoid');
    
    return $this->redirect('prueba/index?fecha='.strtotime($fecha));
     
    }
    }
    else
    {
    $prueba->save();
 
    $this->grupoid = $this->getRequestParameter('grupoid');
    
    return $this->redirect('prueba/index?fecha='.strtotime($fecha));
    }
    
  }
  
  public function executeError()
  {
  
  }
  
    public function executeNotasupdate()
  {
   
   $c = new Criteria();
   $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo'));
   $alumnos = AlumnoPeer::doSelect($c);
   
   $recuento = 0;
   foreach ($alumnos as $alumno):
    $recuento++;
   endforeach; 
   
   if ($recuento != 0)
   {
     foreach ($alumnos as $alumno):
        $nombre = 'id'.$alumno->getId();
        if (!$this->getRequestParameter($nombre))
        {
          $nota = new Notaprueba();    
        }
        else
        {
          $c = new Criteria();
          $c->add(NotapruebaPeer::ALUMNO_ID,$alumno->getId());
          $c->add(NotapruebaPeer::PRUEBA_ID,$this->getRequestParameter('prueba'));
          $nota = NotapruebaPeer::doSelectOne ($c);
          $this->forward404Unless($nota);
        } 
        
        $nota->setId($this->getRequestParameter($nombre));  
        $nota->setAlumnoId($this->getRequestParameter('id_alum'.$alumno->getId()) ? $this->getRequestParameter('id_alum'.$alumno->getId()) : null);
        $nota->setPruebaId($this->getRequestParameter('prueba') ? $this->getRequestParameter('prueba') : null);
        $nota->setObservaciones($this->getRequestParameter('o'.$alumno->getId()));
        $n = $this->getRequestParameter('n'.$alumno->getId());
        $n = str_replace(",",".",$n);
        $nota->setNota($n);
        $nota->setActivo($this->getRequestParameter('a'.$alumno->getId(),0));
        
        $nota->save();
 
     endforeach;
     $prueba_id = $this->getRequestParameter('prueba');
     $grupo = $this->getRequestParameter('grupo'); 
     $grupoid = $this->getRequestParameter('grupoid');
      }  
    return $this->redirect('prueba/alumnolist?prueba='.$prueba_id.'&grupo='.$grupo.'&grupoid='.$grupoid);
  }
  public function executeDelete()
  {
    $prueba = PruebaPeer::retrieveByPk($this->getRequestParameter('id'));
    
    $c = new Criteria();
    $c->add (NotapruebaPeer::PRUEBA_ID,$this->getRequestParameter('id'));
    $notapruebas = NotapruebaPeer::doSelect($c);
    $fecha = $this->getRequestParameter('fecha');
    
    foreach ($notapruebas as $notaprueba):
      $notaprueba->delete();
      $this->forward404Unless($notaprueba);
    endforeach;

    $prueba->delete();
    $this->forward404Unless($prueba);

    return $this->redirect('prueba/index?fecha='.$fecha);
  }
}
