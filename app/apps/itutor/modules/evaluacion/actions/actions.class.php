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
// date: 2008/03/08 13:30:11
?>
<?php

/**
 * evaluacion actions.
 *
 * @package    gesal
 * @subpackage evaluacion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class evaluacionActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('evaluacion', 'list');
  }

  public function executeList()
  {
    $this->evaluaciones = EvaluacionPeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $this->evaluacion = EvaluacionPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->evaluacion);
  }

  public function executeCreate()
  {
    $this->evaluacion = new Evaluacion();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->evaluacion = EvaluacionPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->evaluacion);
  }

  public function executeUpdate()
  {
  if (!$this->getRequestParameter('fechaini') || !$this->getRequestParameter('fechafin'))
   {
     
      $mensaje = 'Las evaluaciones deben tener una fecha de inicio y una de fin.';   
      return $this->redirect('principal/error?mensaje='.$mensaje);
   }
   else
   {
    if (!$this->getRequestParameter('id'))
    {
      $evaluacion = new Evaluacion();
    }
    else
    {
      $evaluacion = EvaluacionPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($evaluacion);
    }

    $evaluacion->setId($this->getRequestParameter('id'));
    $evaluacion->setTitulo($this->getRequestParameter('titulo_ev'));
    if ($this->getRequestParameter('fechaini'))
    {
      list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('fechaini'), $this->getUser()->getCulture());
      $evaluacion->setFechaini("$y-$m-$d");
      
    }
    else
    {
      $today = date('y-m-d');  
      $evaluacion->setFechaini($today);
    }
    if ($this->getRequestParameter('fechafin'))
    {
      list($d, $m, $y) = sfI18N::getDateForCulture($this->getRequestParameter('fechafin'), $this->getUser()->getCulture());
      $evaluacion->setFechafin("$y-$m-$d");
     
    }
    else
    {
      $today = date('y-m-d');  
      $evaluacion->setFechafin($today);
    }
   
    $evaluacion->setObservaciones($this->getRequestParameter('observaciones'));
    $evaluacion->setActivo($this->getRequestParameter('activo', 0));

    $evaluacion->save();

    return $this->redirect('evaluacion/list');
    }
  }

  public function executeDelete()
  {
    $evaluacion = EvaluacionPeer::retrieveByPk($this->getRequestParameter('id'));

    $this->forward404Unless($evaluacion);

    $evaluacion->delete();

    return $this->redirect('evaluacion/list');
  }
}
