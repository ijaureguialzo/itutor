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
// date: 2008/03/11 09:51:15
?>
<?php

/**
 * comportamiento actions.
 *
 * @package    gesal
 * @subpackage comportamiento
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class comportamientoActions extends sfActions
{
   public function executeIndex()
  {
    $this->getUser()->setAttribute('pagina_activa', 'comportamiento');
    $this->fecha = $this->getRequestParameter('fecha');
    
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));
    
    $this->profesor = ProfesorPeer::doSelectOne($d);
    
    $this->c = new Criteria();
    $this->c->addJoin(HorarioPeer::GRUPO_ID, GrupoPeer::ID);
    $this->c->add(HorarioPeer::PROFESOR_ID, $this->profesor->getId());
    $this->c->addAscendingOrderByColumn(GrupoPeer::NOMBRE);
    
    $this->grupos = GrupoPeer::doSelect($this->c);
    
  }

  public function executeDatos()
  {
    $this->fecha = $this->getRequestParameter('fecha');

    $this->grupo = $this->getRequestParameter('grupo');
    
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));

    $this->profesor = ProfesorPeer::doSelectOne($d);

    $this->g = new Criteria();
    $this->g->add(AsignaturaPeer::PROFESOR_ID,$this->profesor->getId());
    $this->g->addAscendingOrderByColumn(AsignaturaPeer::NOMBRE);
    $this->g->add(HorarioPeer::GRUPO_ID,$this->grupo);
    $this->g->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
    $this->g->addJoin(HorarioPeer::ASIGNATURA_ID,AsignaturaPeer::ID);
    $this->asignaturas = AsignaturaPeer::doSelect($this->g);

    $fecha = strtotime("now");

    $c = new Criteria();
    $c->add(GrupoevaluacionPeer::GRUPO_ID, $this->getRequestParameter('grupo'));
    $c->addJoin(EvaluacionPeer::ID,GrupoevaluacionPeer::EVALUACION_ID);
    $c->add(EvaluacionPeer::FECHAINI,$fecha,Criteria::LESS_EQUAL);
    $c->add(EvaluacionPeer::FECHAFIN,$fecha,Criteria::GREATER_EQUAL);
    $this->eva_actual = EvaluacionPeer::doSelectOne($c);

    $this->a = new Criteria();
    $this->a->add(GrupoevaluacionPeer::GRUPO_ID, $this->getRequestParameter('grupo'));
    $this->a->addJoin(EvaluacionPeer::ID,GrupoevaluacionPeer::EVALUACION_ID);
  }

  public function executeList()
  {
  if (!$this->getRequestParameter('grupo') || !$this->getRequestParameter('asignatura') || !$this->getRequestParameter('evaluacion'))
   {
      $mensaje = 'No se puede visualizar el listado sin elegir grupo, asignatura y evaluación.';     
      return $this->redirect('principal/error?mensaje='.$mensaje);
   }
   else
   {
     
    $c = new Criteria();
    $c->addjoin(ComportamientoPeer::ALUMNO_ID,AlumnoPeer::ID);
    $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo'));
    $c->add(ComportamientoPeer::ASIGNATURA_ID,$this->getRequestParameter('asignatura'));
    $c->add(ComportamientoPeer::EVALUACION_ID,$this->getRequestParameter('evaluacion'));
    $c->addAscendingOrderByColumn(ComportamientoPeer::ALUMNO_ID);

    $this->comportamientos = ComportamientoPeer::doSelect($c);
    
    $this->evaluacion = EvaluacionPeer::retrieveByPk($this->getRequestParameter('evaluacion'));
    $this->asignatura = AsignaturaPeer::retrieveByPk($this->getRequestParameter('asignatura'));
    $this->grupo = GrupoPeer::retrieveByPk($this->getRequestParameter('grupo'));
    
    $d = new Criteria();
    $d->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo'));
    $d->addAscendingOrderByColumn(AlumnoPeer::NOMBRE);
    $this->alumnos = AlumnoPeer::doSelect($d);
    
    }
  }

  public function executeShow()
  {
    $this->comportamiento = ComportamientoPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->grupo = $this->getRequestParameter('grupo');
    
    $this->alumno = AlumnoPeer::retrieveByPk($this->comportamiento->getAlumnoId());
    $this->asignatura = AsignaturaPeer::retrieveByPk($this->comportamiento->getAsignaturaId());
    $this->evaluacion = EvaluacionPeer::retrieveByPk($this->comportamiento->getEvaluacionId());
    $this->forward404Unless($this->comportamiento);
  }

  public function executeCreate()
  {
  if (!$this->getRequestParameter('alumno'))
  {
      $mensaje = 'No se puede crear el registro sin elegir un alumno.';       
      return $this->redirect('principal/error?mensaje='.$mensaje);
   }
   else
   {
    $this->comportamiento = new Comportamiento();
    
    $this->comportamiento->setAlumnoId($this->getRequestParameter('alumno'));
    $this->comportamiento->setAsignaturaId($this->getRequestParameter('asignatura'));
    $this->comportamiento->setEvaluacionId($this->getRequestParameter('evaluacion'));
    
    $this->grupo = $this->getRequestParameter('grupo');
    
    $this->alumno = AlumnoPeer::retrieveByPk($this->getRequestParameter('alumno'));
    $this->asignatura = AsignaturaPeer::retrieveByPk($this->getRequestParameter('asignatura'));
    $this->evaluacion = EvaluacionPeer::retrieveByPk($this->getRequestParameter('evaluacion'));

    $this->setTemplate('edit');
    }
  }
  
  public function executeGenerar()
  {
    $c = new Criteria();
    $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo'));
    $this->alumnos = AlumnoPeer::doSelect($c);
    
    foreach ($this->alumnos as $alumno):
      $comportamiento = new Comportamiento();
    
      $comportamiento->setAlumnoId($alumno->getId());
      $comportamiento->setAsignaturaId($this->getRequestParameter('asig'));
      $comportamiento->setEvaluacionId($this->getRequestParameter('ev'));

      $comportamiento->save();
    endforeach; 

    return $this->redirect('comportamiento/list?grupo='.$this->getRequestParameter('grupo').'&asignatura='.$this->getRequestParameter('asig').'&evaluacion='.$this->getRequestParameter('ev'));
    
  }

  public function executeRegenerar()
  {
    $c = new Criteria();
    $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo'));
    $this->alumnos = AlumnoPeer::doSelect($c);

    $c = new Criteria();
    $c->add(ComportamientoPeer::ASIGNATURA_ID,$this->getRequestParameter('asig'));
    $c->add(ComportamientoPeer::EVALUACION_ID,$this->getRequestParameter('ev'));
    $c->addJoin(ComportamientoPeer::ALUMNO_ID,AlumnoPeer::ID);
    $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupo'));

    $comportamientos = ComportamientoPeer::doSelect($c);

    foreach ($comportamientos as $comportamiento):
        $comportamiento->delete();
    endforeach;
    
    foreach ($this->alumnos as $alumno):
      $comportamiento = new Comportamiento();

      $comportamiento->setAlumnoId($alumno->getId());
      $comportamiento->setAsignaturaId($this->getRequestParameter('asig'));
      $comportamiento->setEvaluacionId($this->getRequestParameter('ev'));

      $comportamiento->save();
    endforeach;

    return $this->redirect('comportamiento/list?grupo='.$this->getRequestParameter('grupo').'&asignatura='.$this->getRequestParameter('asig').'&evaluacion='.$this->getRequestParameter('ev'));

  }

  public function executeEdit()
  {
    $this->comportamiento = ComportamientoPeer::retrieveByPk($this->getRequestParameter('id'));
    
    $this->alumno = AlumnoPeer::retrieveByPk($this->comportamiento->getAlumnoId());
    $this->asignatura = AsignaturaPeer::retrieveByPk($this->comportamiento->getAsignaturaId());
    $this->evaluacion = EvaluacionPeer::retrieveByPk($this->comportamiento->getEvaluacionId());
    
    $this->grupo = $this->getRequestParameter('grupo');
    $this->forward404Unless($this->comportamiento);
  }

  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $comportamiento = new Comportamiento();
    }
    else
    {
      $comportamiento = ComportamientoPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($comportamiento);
    }
     
    $this->grupo = $this->getRequestParameter('grupo');
    $comportamiento->setId($this->getRequestParameter('id'));
    $comportamiento->setAlumnoId($this->getRequestParameter('alumno') ? $this->getRequestParameter('alumno') : null);
    $comportamiento->setEvaluacionId($this->getRequestParameter('evaluacion') ? $this->getRequestParameter('evaluacion') : null);
    $comportamiento->setAsignaturaId($this->getRequestParameter('asignatura') ? $this->getRequestParameter('asignatura') : null);
    $comportamiento->setNota($this->getRequestParameter('nota'));
    $comportamiento->setObservaciones($this->getRequestParameter('observaciones'));
    $comportamiento->setActivo($this->getRequestParameter('activo', 0));

    $comportamiento->save();

    return $this->redirect('comportamiento/index');
  }
  
  public function executeUpdateall()
  {
    $c = new Criteria();
    $c->addJoin(ComportamientoPeer::ALUMNO_ID,AlumnoPeer::ID);
    $c->add(AlumnoPeer::GRUPO_ID,$this->getRequestParameter('grupoid'));
    $c->add(ComportamientoPeer::ASIGNATURA_ID,$this->getRequestParameter('asignaturaid'));
    $c->add(ComportamientoPeer::EVALUACION_ID,$this->getRequestParameter('evaluacionid'));
    $c->addAscendingOrderByColumn(ComportamientoPeer::ALUMNO_ID);
    
    $comportamientos = ComportamientoPeer::doSelect($c);
    
    foreach ($comportamientos as $comportamiento):
      if ($this->getRequestParameter('nota'.$comportamiento->getId()))
      {
        $nota = $this->getRequestParameter('nota'.$comportamiento->getId());
          $nota = str_replace(",",".",$nota);
        $comportamiento->setNota($nota);
      }
        else
        {
            $comportamiento->setNota(0);
        }
      $comportamiento->setObservaciones($this->getRequestParameter('observaciones'.$comportamiento->getId()));
      
      $comportamiento->save();
    endforeach;
    
    return $this->redirect('comportamiento/index');
  }

  public function executeDelete()
  {
    $comportamiento = ComportamientoPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($comportamiento);

    $comportamiento->delete();

    return $this->redirect('comportamiento/index');
  }
}
