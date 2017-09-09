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
// date: 2008/03/26 11:04:34
?>
<?php

/**
 * diario actions.
 *
 * @package    gesal
 * @subpackage diario
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class diarioActions extends sfActions
{
  public function executeIndex()
  {
    $this->fecha = getdate($this->getRequestParameter('fecha'));
    
    switch($this->fecha['mon'])
    {
      case 1:
        $this->dias = 31;
        break;
      case 2:
        if ($this->fecha['year']%4 == 0 && $this->fechar['year']%100 != 0)
        {
          $this->dias = 29;
        } 
        elseif ($this->fecha['year']%4 == 0 && $this->fechar['year']%100 == 0 && $this->fechar['year']%400 == 0) 
        {
          $this->dias = 29;        
        } 
        else
        {
          $this->dias = 28;        
        }
        break; 
      case 3:
        $this->dias = 31;
        break;
      case 4:
        $this->dias = 30;
        break;
      case 5:
        $this->dias = 31;
        break;
      case 6:
        $this->dias = 30;
        break;
      case 7:
        $this->dias = 31;
        break;
      case 8:
        $this->dias = 31;
        break;
      case 9:
        $this->dias = 30;
        break;
      case 10:
        $this->dias = 31;
        break;
      case 11:
        $this->dias = 30;
        break;
      case 12:
        $this->dias = 31;
        break;
    }
    
    $this->festivos = FestivoPeer::doSelect (new Criteria());
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));
    
    $this->profesor = ProfesorPeer::doSelectOne($d);
        
    $c = new Criteria();
    $c->add(DiarioPeer::PROFESOR_ID,$this->profesor->getId());
    
    $this->diarios = DiarioPeer::doSelect($c);
    
    $this->optionsl = array();
    $this->optionsm = array();
    $this->optionsx = array();
    $this->optionsj = array();
    $this->optionsv = array();
    
    for ($dia = 1; $dia < 6; $dia++)
    {
    $c = new Criteria();
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
    $c->add(HorarioPeer::DIA,$dia);
    
    $horarios = HorarioPeer::doSelect($c);
    
    $c = new Criteria();
    $c->addJoin(HorarioPeer::GRUPO_ID,GrupoPeer::ID);
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
    $c->setDistinct();
    
    $grupos = GrupoPeer::doSelect ($c);
    
    $c = new Criteria();
    $c->add(AsignaturaPeer::PROFESOR_ID,$this->profesor->getId());
    
    $asignaturas = AsignaturaPeer::doSelect($c);
    
    foreach ($horarios as $horario)
    {
      foreach($grupos as $grupo)
      {
        if($horario->getGrupoId() == $grupo->getId())
        {
          $nombre_grupo = $grupo->getNombre();
          $id_grupo = $grupo->getId();        
        }
      }
      foreach($asignaturas as $asignatura)
      {
        if($horario->getAsignaturaId() == $asignatura->getId())
        {
          $nombre_asignatura = $asignatura->getNombre(); 
          $id_asignatura = $asignatura->getId();       
        }
      }
      
      $c = new Criteria();
      $c->add(HorarioPeer::DIA,$dia);
      $c->add(HorarioPeer::GRUPO_ID,$id_grupo);
      $c->add(HorarioPeer::ASIGNATURA_ID,$id_asignatura);
      
      $hor = HorarioPeer::doSelect($c);
      $horas = count($hor);
      
      $repetido = false;
      if($dia == 1)
      { 
      foreach ($this->optionsl as $option)
      {
        if ($option == $nombre_grupo.' - '.$nombre_asignatura )
          {
            $repetido = true;
          } 
      }
      if ($repetido == false)
      {    
          $this->optionsl[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura;
      }
      }
      if($dia == 2)
      { 
      foreach ($this->optionsm as $option)
      {
        if ($option == $nombre_grupo.' - '.$nombre_asignatura )
          {
            $repetido = true;
          } 
      }
      if ($repetido == false)
      {    
          $this->optionsm[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura;
      }
      }
      if($dia == 3)
      { 
      foreach ($this->optionsx as $option)
      {
        if ($option == $nombre_grupo.' - '.$nombre_asignatura )
          {
            $repetido = true;
          } 
      }
      if ($repetido == false)
      {    
          $this->optionsx[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura;
      }
      }
      if($dia == 4)
      { 
      foreach ($this->optionsj as $option)
      {
        if ($option == $nombre_grupo.' - '.$nombre_asignatura )
          {
            $repetido = true;
          } 
      }
      if ($repetido == false)
      {    
          $this->optionsj[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura;
      }
      }
      if($dia == 5)
      { 
      foreach ($this->optionsv as $option)
      {
        if ($option == $nombre_grupo.' - '.$nombre_asignatura )
          {
            $repetido = true;
          } 
      }
      if ($repetido == false)
      {    
          $this->optionsv[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura;
      }
      }
     }
    }
  }
  
 
  
  public function executeGrupodia()
  {
    $this->fecha = getdate($this->getRequestParameter('dia'));
    
    $dia = $this->fecha['wday'];
    
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));
    
    $this->profesor = ProfesorPeer::doSelectOne($d);
    
    $c = new Criteria();
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
    $c->add(HorarioPeer::DIA,$dia);
    
    $this->horarios = HorarioPeer::doSelect($c);
    
    $c = new Criteria();
    $c->addJoin(HorarioPeer::GRUPO_ID,GrupoPeer::ID);
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
    $c->setDistinct();
    
    $this->grupos = GrupoPeer::doSelect ($c);
    
    $c = new Criteria();
    $c->add(AsignaturaPeer::PROFESOR_ID,$this->profesor->getId());
    $this->asignaturas = AsignaturaPeer::doSelect($c);
    
    $options = array();
    foreach ($this->horarios as $horario)
    {
      foreach($this->grupos as $grupo)
      {
        if($horario->getGrupoId() == $grupo->getId())
        {
          $nombre_grupo = $grupo->getNombre();
          $id_grupo = $grupo->getId();        
        }
      }
      foreach($this->asignaturas as $asignatura)
      {
        if($horario->getAsignaturaId() == $asignatura->getId())
        {
          $nombre_asignatura = $asignatura->getNombre(); 
          $id_asignatura = $asignatura->getId();       
        }
      }
      
      $c = new Criteria();
      $c->add(HorarioPeer::DIA,$dia);
      $c->add(HorarioPeer::GRUPO_ID,$id_grupo);
      $c->add(HorarioPeer::ASIGNATURA_ID,$id_asignatura);
      
      $hor = HorarioPeer::doSelect($c);
      $horas = count($hor);
      
      if ($this->getUser()->getCulture() == 'es')
      { 
        $repetido = false; 
        foreach ($options as $option)
        {
          if ($option == $nombre_grupo.' - '.$nombre_asignatura.' ('.$horas.' h)')
          {
            $repetido = true;
          } 
        }
        if ($repetido == false)
        {    
          $options[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura.' ('.$horas.' h)';
        }
      }
      if ($this->getUser()->getCulture() == 'eu')
      { 
        $repetido = false; 
        foreach ($options as $option)
        {
          if ($option == $nombre_grupo.' - '.$nombre_asignatura.' ('.$horas.' ordu)')
          {
            $repetido = true;
          } 
        }
        if ($repetido == false)
        {     
          $options[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura.' ('.$horas.' ordu)';
        }
      }
      
    }
    $this->options = $options;
  }
  
  public function executeDiario()
  {
  if (!$this->getRequestParameter('opcion'))
   {
      $mensaje = 'No se puede visualizar el listado sin elegir una opción.';     
      return $this->redirect('principal/error?mensaje='.$mensaje);
   }
   else
   {
    $this->fecha = getdate($this->getRequestParameter('fecha'));
    
    $opcion = $this->getRequestParameter('opcion');
    
    $horario = HorarioPeer::retrieveByPk($opcion);
    
    $this->grupo = GrupoPeer::retrieveByPk($horario->getGrupoId());
    
    $this->asignatura = AsignaturaPeer::retrieveByPk($horario->getAsignaturaId());
    
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));
    
    $this->profesor = ProfesorPeer::doSelectOne($d);
    
    $date = date('Y-m-d',$this->fecha[0]);
    
    $c = new Criteria();
    $c->add(DiarioPeer::PROFESOR_ID,$this->profesor->getId());
    $c->add(DiarioPeer::GRUPO_ID,$this->grupo->getId());
    $c->add(DiarioPeer::ASIGNATURA_ID,$this->asignatura->getId());
    $c->add(DiarioPeer::FECHA,$date);
    
    $this->diario = DiarioPeer::doSelectOne($c);
    
    if ($this->diario)
    {
      return $this->redirect('diario/show?id='.$this->diario->getId());    
    }
    else
    {
      $this->diario = new Diario();
      
      $this->diario->setProfesorId($this->profesor->getId());
      $this->diario->setGrupoId($this->grupo->getId());
      $this->diario->setAsignaturaId($this->asignatura->getId());
      $this->diario->setFecha($date);
      
      $c = new Criteria();
      $c->add(EvaluacionPeer::FECHAINI,$date,Criteria::LESS_EQUAL);
      $c->add(EvaluacionPeer::FECHAFIN,$date,Criteria::GREATER_EQUAL);
      
      $this->evaluacion = EvaluacionPeer::doSelectOne($c);
      
      $this->diario->setEvaluacionId($this->evaluacion->getId());
      
      $this->setTemplate('edit');
    }
    }
  }

  public function executeOpciongrupo()
  {
    $this->opcion = $this->getRequestParameter('opcion');

    $this->horario = HorarioPeer::retrieveBypk($this->opcion);


    $fe = strtotime("now");
    
    $c = new Criteria();
    $c->add(EvaluacionPeer::FECHAINI,$fe,Criteria::LESS_EQUAL);
    $c->add(EvaluacionPeer::FECHAFIN,$fe,Criteria::GREATER_EQUAL);
    $c->add(GrupoevaluacionPeer::GRUPO_ID,$this->horario->getGrupoId());
    $c->addJoin(GrupoevaluacionPeer::EVALUACION_ID,EvaluacionPeer::ID);
    $this->eva_actual = EvaluacionPeer::doSelectOne($c);

    $this->a = new Criteria();
    $this->a->add(GrupoevaluacionPeer::GRUPO_ID,$this->horario->getGrupoId());
    $this->a->addJoin(GrupoevaluacionPeer::EVALUACION_ID,EvaluacionPeer::ID);


  }

  public function executeList()
  {  
    
    
    
    $this->fecha = getdate($this->getRequestParameter('fecha'));

    $fe = $this->getRequestParameter('fecha');

    switch($this->fecha['mon'])
    {
      case 1:
        $this->dias = 31;
        break;
      case 2:
        if ($this->fecha['year']%4 == 0 && $this->fechar['year']%100 != 0)
        {
          $this->dias = 29;
        }
        elseif ($this->fecha['year']%4 == 0 && $this->fechar['year']%100 == 0 && $this->fechar['year']%400 == 0)
        {
          $this->dias = 29;
        }
        else
        {
          $this->dias = 28;
        }
        break;
      case 3:
        $this->dias = 31;
        break;
      case 4:
        $this->dias = 30;
        break;
      case 5:
        $this->dias = 31;
        break;
      case 6:
        $this->dias = 30;
        break;
      case 7:
        $this->dias = 31;
        break;
      case 8:
        $this->dias = 31;
        break;
      case 9:
        $this->dias = 30;
        break;
      case 10:
        $this->dias = 31;
        break;
      case 11:
        $this->dias = 30;
        break;
      case 12:
        $this->dias = 31;
        break;
    }

    $this->festivos = FestivoPeer::doSelect (new Criteria());
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));

    $this->profesor = ProfesorPeer::doSelectOne($d);

    $c = new Criteria();
    $c->add(DiarioPeer::PROFESOR_ID,$this->profesor->getId());

    $this->diarios = DiarioPeer::doSelect($c);

    $this->optionsl = array();
    $this->optionsm = array();
    $this->optionsx = array();
    $this->optionsj = array();
    $this->optionsv = array();

    for ($dia = 1; $dia < 6; $dia++)
    {
    $c = new Criteria();
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
    $c->add(HorarioPeer::DIA,$dia);

    $c->addJoin(HorarioPeer::GRUPO_ID,GrupoPeer::ID);
    $c->addJoin(GrupoPeer::ID,GrupoevaluacionPeer::GRUPO_ID);
    $c->addJoin(EvaluacionPeer::ID,GrupoevaluacionPeer::EVALUACION_ID);
    $c->add(EvaluacionPeer::FECHAINI,$fe,Criteria::LESS_EQUAL);
    $c->add(EvaluacionPeer::FECHAFIN,$fe,Criteria::GREATER_EQUAL);

    $horarios = HorarioPeer::doSelect($c);

    $c = new Criteria();
    $c->addJoin(HorarioPeer::GRUPO_ID,GrupoPeer::ID);
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
    $c->setDistinct();

    $grupos = GrupoPeer::doSelect ($c);

    $c = new Criteria();
    $c->add(AsignaturaPeer::PROFESOR_ID,$this->profesor->getId());

    $asignaturas = AsignaturaPeer::doSelect($c);

    foreach ($horarios as $horario)
    {
      foreach($grupos as $grupo)
      {
        if($horario->getGrupoId() == $grupo->getId())
        {
          $nombre_grupo = $grupo->getNombre();
          $id_grupo = $grupo->getId();
        }
      }
      foreach($asignaturas as $asignatura)
      {
        if($horario->getAsignaturaId() == $asignatura->getId())
        {
          $nombre_asignatura = $asignatura->getNombre();
          $id_asignatura = $asignatura->getId();
        }
      }

      $c = new Criteria();
      $c->add(HorarioPeer::DIA,$dia);
      $c->add(HorarioPeer::GRUPO_ID,$id_grupo);
      $c->add(HorarioPeer::ASIGNATURA_ID,$id_asignatura);

      $hor = HorarioPeer::doSelect($c);
      $horas = count($hor);

      $repetido = false;
      if($dia == 1)
      {
      foreach ($this->optionsl as $option)
      {
        if ($option == $nombre_grupo.' - '.$nombre_asignatura )
          {
            $repetido = true;
          }
      }
      if ($repetido == false)
      {
          $this->optionsl[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura;
      }
      }
      if($dia == 2)
      {
      foreach ($this->optionsm as $option)
      {
        if ($option == $nombre_grupo.' - '.$nombre_asignatura )
          {
            $repetido = true;
          }
      }
      if ($repetido == false)
      {
          $this->optionsm[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura;
      }
      }
      if($dia == 3)
      {
      foreach ($this->optionsx as $option)
      {
        if ($option == $nombre_grupo.' - '.$nombre_asignatura )
          {
            $repetido = true;
          }
      }
      if ($repetido == false)
      {
          $this->optionsx[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura;
      }
      }
      if($dia == 4)
      {
      foreach ($this->optionsj as $option)
      {
        if ($option == $nombre_grupo.' - '.$nombre_asignatura )
          {
            $repetido = true;
          }
      }
      if ($repetido == false)
      {
          $this->optionsj[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura;
      }
      }
      if($dia == 5)
      {
      foreach ($this->optionsv as $option)
      {
        if ($option == $nombre_grupo.' - '.$nombre_asignatura )
          {
            $repetido = true;
          }
      }
      if ($repetido == false)
      {
          $this->optionsv[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura;
      }
      }
     }
    }
     
    $d = new Criteria();
    $d->add(ProfesorPeer::CODIGO,$this->getUser()->getAttribute('codigo'));
    
    $this->profesor = ProfesorPeer::doSelectOne($d);
    
    $c = new Criteria();
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
    
    $this->horarios = HorarioPeer::doSelect($c);
    
    $c = new Criteria();
    $c->addJoin(HorarioPeer::GRUPO_ID,GrupoPeer::ID);
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
    $c->setDistinct();
    
    $this->grupos = GrupoPeer::doSelect ($c);
    
    $c = new Criteria();
    $c->add(AsignaturaPeer::PROFESOR_ID,$this->profesor->getId());
    $this->asignaturas = AsignaturaPeer::doSelect($c);
    
    $options = array();
    foreach ($this->horarios as $horario)
    {
      foreach($this->grupos as $grupo)
      {
        if($horario->getGrupoId() == $grupo->getId())
        {
          $nombre_grupo = $grupo->getNombre();
          $id_grupo = $grupo->getId();        
        }
      }
      foreach($this->asignaturas as $asignatura)
      {
        if($horario->getAsignaturaId() == $asignatura->getId())
        {
          $nombre_asignatura = $asignatura->getNombre(); 
          $id_asignatura = $asignatura->getId();       
        }
      }
            
      if ($this->getUser()->getCulture() == 'es')
      { 
        $repetido = false; 
        foreach ($options as $option)
        {
          if ($option == $nombre_grupo.' - '.$nombre_asignatura)
          {
            $repetido = true;
          } 
        }
        if ($repetido == false)
        {    
          $options[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura;
        }
      }
      if ($this->getUser()->getCulture() == 'eu')
      { 
        $repetido = false; 
        foreach ($options as $option)
        {
          if ($option == $nombre_grupo.' - '.$nombre_asignatura)
          {
            $repetido = true;
          } 
        }
        if ($repetido == false)
        {     
          $options[$horario->getId()] = $nombre_grupo.' - '.$nombre_asignatura;
        }
      }
      
    }
    $this->options = $options;
  }
  
   //Genera todas las entradas del diario
  public function executeGenerar()
  {
    $this->fecha = getdate($this->getRequestParameter('fecha'));
    
    $this->opcion = $this->getRequestParameter('opcion');
    
    $this->horario = HorarioPeer::retrieveBypk($this->opcion);
    
    $id_evaluacion = $this->getRequestParameter('ev');
    
    $this->evaluacion = EvaluacionPeer::retrieveByPk($id_evaluacion);
    $this->grupo = GrupoPeer::retrieveByPk($this->horario->getGrupoId());
    $this->asignatura = AsignaturaPeer::retrieveByPk($this->horario->getAsignaturaId());
    $this->profesor = ProfesorPeer::retrieveByPk($this->horario->getProfesorId());
    
    $c = new Criteria();
    $c->add(FestivoPeer::FECHA,$this->evaluacion->getFechaini(),Criteria::GREATER_EQUAL);
    $c->add(FestivoPeer::FECHA,$this->evaluacion->getFechafin(),Criteria::LESS_EQUAL);
    $this->festivos = FestivoPeer::doSelect($c);
    
    $c = new Criteria();
    $c->add(HorarioPeer::GRUPO_ID,$this->grupo->getId());
    $c->add(HorarioPeer::ASIGNATURA_ID,$this->asignatura->getId());
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
      
    $hor = HorarioPeer::doSelect($c);
    
    $horas = array();
    for($x=1;$x<=5;$x++)
    {
      $horas[$x] = 0;    
    }
    foreach ($hor as $hora)
    {
      switch($hora->getDia())
      {
        case 1:
          $horas[1] = $horas[1] + 1;
          break; 
        case 2:
          $horas[2] = $horas[2] + 1;
          break; 
        case 3:
          $horas[3] = $horas[3] + 1;
          break; 
        case 4:
          $horas[4] = $horas[4] + 1;
          break; 
        case 5: 
          $horas[5] = $horas[5] + 1;
          break;      
      }
    }
    $this->horas = $horas;
    
    //Crear las entradas del diario
    $fe = strtotime($this->evaluacion->getFechaini());
    $fec = date('Y-m-d',$fe);

    while ($fec >= $this->evaluacion->getFechaini() && $fec <= $this->evaluacion->getFechafin())
    {
    $fecha = getdate($fe);
    $fecha['wday'];
    //Encontrar si la fecha actual es festivo
    $encontrado = false;
    foreach ($this->festivos as $festivo):
      if ( $festivo->getFecha() == $fec )
      {
        $encontrado = true;
      } 
    endforeach;
    
    if ($fecha['wday'] >= 1 && $fecha['wday'] <= 5)
    {
      if ($encontrado == false && $horas[$fecha['wday']] != 0)
      {
        $diario = new Diario();
        
        $diario->setEvaluacionId($this->evaluacion->getId());
        $diario->setAsignaturaId($this->asignatura->getId());
        $diario->setProfesorId($this->profesor->getId());    
        $diario->setGrupoId($this->grupo->getId());
        $diario->setFecha($fec);

        $diario->save();
      }
    }
    $fe = strtotime("+1 day",$fe);
    $fec = date('Y-m-d',$fe);
    
    }
    return $this->redirect('diario/listado?fecha='.$this->fecha[0].'&evaluacion='.$this->evaluacion->getId().'&opcion='.$this->opcion);
    
  }

  public function executeRegenerar()
  {
    $this->fecha = getdate($this->getRequestParameter('fecha'));
    
    $this->opcion = $this->getRequestParameter('opcion');

    $this->horario = HorarioPeer::retrieveBypk($this->opcion);

    $id_evaluacion = $this->getRequestParameter('ev');

    $this->evaluacion = EvaluacionPeer::retrieveByPk($id_evaluacion);
    $this->grupo = GrupoPeer::retrieveByPk($this->horario->getGrupoId());
    $this->asignatura = AsignaturaPeer::retrieveByPk($this->horario->getAsignaturaId());
    $this->profesor = ProfesorPeer::retrieveByPk($this->horario->getProfesorId());

    $c = new Criteria();
    $c->add(FestivoPeer::FECHA,$this->evaluacion->getFechaini(),Criteria::GREATER_EQUAL);
    $c->add(FestivoPeer::FECHA,$this->evaluacion->getFechafin(),Criteria::LESS_EQUAL);
    $this->festivos = FestivoPeer::doSelect($c);

    $c = new Criteria();
    $c->add(HorarioPeer::GRUPO_ID,$this->grupo->getId());
    $c->add(HorarioPeer::ASIGNATURA_ID,$this->asignatura->getId());
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());

    $hor = HorarioPeer::doSelect($c);

    //Eliminar el diario para volver a crearlo despues
    $c = new Criteria();
    $c->add(DiarioPeer::EVALUACION_ID,$this->evaluacion->getId());
    $c->add(DiarioPeer::ASIGNATURA_ID,$this->asignatura->getId());
    $c->add(DiarioPeer::PROFESOR_ID,$this->profesor->getId());
    $c->add(DiarioPeer::GRUPO_ID,$this->grupo->getId());

    $diarios = DiarioPeer::doSelect($c);

    foreach ($diarios as $diario):
        $diario->delete();
    endforeach;
    //Termina eliminar diario

    $horas = array();
    for($x=1;$x<=5;$x++)
    {
      $horas[$x] = 0;
    }
    foreach ($hor as $hora)
    {
      switch($hora->getDia())
      {
        case 1:
          $horas[1] = $horas[1] + 1;
          break;
        case 2:
          $horas[2] = $horas[2] + 1;
          break;
        case 3:
          $horas[3] = $horas[3] + 1;
          break;
        case 4:
          $horas[4] = $horas[4] + 1;
          break;
        case 5:
          $horas[5] = $horas[5] + 1;
          break;
      }
    }
    $this->horas = $horas;

    //Crear las entradas del diario
    $fe = strtotime($this->evaluacion->getFechaini());
    $fec = date('Y-m-d',$fe);

    while ($fec >= $this->evaluacion->getFechaini() && $fec <= $this->evaluacion->getFechafin())
    {
    $fecha = getdate($fe);
    $fecha['wday'];
    //Encontrar si la fecha actual es festivo
    $encontrado = false;
    foreach ($this->festivos as $festivo):
      if ( $festivo->getFecha() == $fec )
      {
        $encontrado = true;
      }
    endforeach;

    if ($fecha['wday'] >= 1 && $fecha['wday'] <= 5)
    {
      if ($encontrado == false && $horas[$fecha['wday']] != 0)
      {
        $diario = new Diario();

        $diario->setEvaluacionId($this->evaluacion->getId());
        $diario->setAsignaturaId($this->asignatura->getId());
        $diario->setProfesorId($this->profesor->getId());
        $diario->setGrupoId($this->grupo->getId());
        $diario->setFecha($fec);

        $diario->save();
      }
    }
    $fe = strtotime("+1 day",$fe);
    $fec = date('Y-m-d',$fe);

    }
    return $this->redirect('diario/listado?fecha='.$this->fecha[0].'&evaluacion='.$this->evaluacion->getId().'&opcion='.$this->opcion);

  }

  public function executeImprimir()
  {
    $this->fecha = getdate($this->getRequestParameter('fecha'));


    $this->grupo = GrupoPeer::retrieveByPk($this->getRequestParameter('grupo'));
    $this->asignatura = AsignaturaPeer::retrieveByPk($this->getRequestParameter('asig'));
    $this->profesor = ProfesorPeer::retrieveByPk($this->getRequestParameter('prof'));
    $this->evaluacion = EvaluacionPeer::retrieveByPk($this->getRequestParameter('ev'));

    $c = new Criteria();
    $c->add(FestivoPeer::FECHA,$this->evaluacion->getFechaini(),Criteria::GREATER_EQUAL);
    $c->add(FestivoPeer::FECHA,$this->evaluacion->getFechafin(),Criteria::LESS_EQUAL);
    $this->festivos = FestivoPeer::doSelect($c);

    $c = new Criteria();
    $c->add(DiarioPeer::GRUPO_ID,$this->grupo->getId());
    $c->add(DiarioPeer::ASIGNATURA_ID,$this->asignatura->getId());
    $c->add(DiarioPeer::PROFESOR_ID,$this->profesor->getId());
    $c->add(DiarioPeer::EVALUACION_ID,$this->evaluacion->getId());
    $c->addAscendingOrderByColumn(DiarioPeer::FECHA);

    $this->diarios = DiarioPeer::doSelect($c);

    $c = new Criteria();
    $c->add(HorarioPeer::GRUPO_ID,$this->grupo->getId());
    $c->add(HorarioPeer::ASIGNATURA_ID,$this->asignatura->getId());
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());

    $hor = HorarioPeer::doSelect($c);

    $horas = array();
    for($x=1;$x<=5;$x++)
    {
      $horas[$x] = 0;
    }
    foreach ($hor as $hora)
    {
      switch($hora->getDia())
      {
        case 1:
          $horas[1] = $horas[1] + 1;
          break;
        case 2:
          $horas[2] = $horas[2] + 1;
          break;
        case 3:
          $horas[3] = $horas[3] + 1;
          break;
        case 4:
          $horas[4] = $horas[4] + 1;
          break;
        case 5:
          $horas[5] = $horas[5] + 1;
          break;
      }
    }
    $this->horas = $horas;

  }

  public function executeImprimirud()
  {
    $this->fecha = getdate($this->getRequestParameter('fecha'));


    $this->grupo = GrupoPeer::retrieveByPk($this->getRequestParameter('grupo'));
    $this->asignatura = AsignaturaPeer::retrieveByPk($this->getRequestParameter('asig'));
    $this->profesor = ProfesorPeer::retrieveByPk($this->getRequestParameter('prof'));
    $this->evaluacion = EvaluacionPeer::retrieveByPk($this->getRequestParameter('ev'));

    $c = new Criteria();
    $c->add(FestivoPeer::FECHA,$this->evaluacion->getFechaini(),Criteria::GREATER_EQUAL);
    $c->add(FestivoPeer::FECHA,$this->evaluacion->getFechafin(),Criteria::LESS_EQUAL);
    $this->festivos = FestivoPeer::doSelect($c);

    $c = new Criteria();
    $c->add(DiarioPeer::GRUPO_ID,$this->grupo->getId());
    $c->add(DiarioPeer::ASIGNATURA_ID,$this->asignatura->getId());
    $c->add(DiarioPeer::PROFESOR_ID,$this->profesor->getId());
    $c->add(DiarioPeer::EVALUACION_ID,$this->evaluacion->getId());
    $c->addAscendingOrderByColumn(DiarioPeer::FECHA);

    $this->diarios = DiarioPeer::doSelect($c);

    $c = new Criteria();
    $c->add(HorarioPeer::GRUPO_ID,$this->grupo->getId());
    $c->add(HorarioPeer::ASIGNATURA_ID,$this->asignatura->getId());
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());

    $hor = HorarioPeer::doSelect($c);

    $horas = array();
    for($x=1;$x<=5;$x++)
    {
      $horas[$x] = 0;
    }
    foreach ($hor as $hora)
    {
      switch($hora->getDia())
      {
        case 1:
          $horas[1] = $horas[1] + 1;
          break;
        case 2:
          $horas[2] = $horas[2] + 1;
          break;
        case 3:
          $horas[3] = $horas[3] + 1;
          break;
        case 4:
          $horas[4] = $horas[4] + 1;
          break;
        case 5:
          $horas[5] = $horas[5] + 1;
          break;
      }
    }
    $this->horas = $horas;

  }
  
  public function executeListado()
  {
    $this->fecha = getdate($this->getRequestParameter('fecha'));
    
    $this->opcion = $this->getRequestParameter('opcion');
    
    $this->horario = HorarioPeer::retrieveBypk($this->opcion);
    
    $id_evaluacion = $this->getRequestParameter('evaluacion');
    
    
    $this->grupo = GrupoPeer::retrieveByPk($this->horario->getGrupoId());
    $this->asignatura = AsignaturaPeer::retrieveByPk($this->horario->getAsignaturaId());
    $this->profesor = ProfesorPeer::retrieveByPk($this->horario->getProfesorId());
    $this->evaluacion = EvaluacionPeer::retrieveByPk($id_evaluacion);
    
    $c = new Criteria();
    $c->add(FestivoPeer::FECHA,$this->evaluacion->getFechaini(),Criteria::GREATER_EQUAL);
    $c->add(FestivoPeer::FECHA,$this->evaluacion->getFechafin(),Criteria::LESS_EQUAL);
    $this->festivos = FestivoPeer::doSelect($c);
    
    $c = new Criteria();
    $c->add(DiarioPeer::GRUPO_ID,$this->grupo->getId());
    $c->add(DiarioPeer::ASIGNATURA_ID,$this->asignatura->getId());
    $c->add(DiarioPeer::PROFESOR_ID,$this->profesor->getId());
    $c->add(DiarioPeer::EVALUACION_ID,$this->evaluacion->getId());
    $c->addAscendingOrderByColumn(DiarioPeer::FECHA); 
    
    $this->diarios = DiarioPeer::doSelect($c);
    
    $c = new Criteria();
    $c->add(HorarioPeer::GRUPO_ID,$this->grupo->getId());
    $c->add(HorarioPeer::ASIGNATURA_ID,$this->asignatura->getId());
    $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
      
    $hor = HorarioPeer::doSelect($c);
    
    $horas = array();
    for($x=1;$x<=5;$x++)
    {
      $horas[$x] = 0;    
    }
    foreach ($hor as $hora)
    {
      switch($hora->getDia())
      {
        case 1:
          $horas[1] = $horas[1] + 1;
          break; 
        case 2:
          $horas[2] = $horas[2] + 1;
          break; 
        case 3:
          $horas[3] = $horas[3] + 1;
          break; 
        case 4:
          $horas[4] = $horas[4] + 1;
          break; 
        case 5: 
          $horas[5] = $horas[5] + 1;
          break;      
      }
    }
    $this->horas = $horas;
  }

  public function executeShow()
  {
    $this->diario = DiarioPeer::retrieveByPk($this->getRequestParameter('id'));
    
    $this->profesor = ProfesorPeer::retrieveByPk($this->diario->getProfesorId());
    $this->grupo = GrupoPeer::retrieveByPk($this->diario->getGrupoId());
    $this->asignatura = AsignaturaPeer::retrieveByPk($this->diario->getAsignaturaId());
    $this->evaluacion = EvaluacionPeer::retrieveByPk($this->diario->getEvaluacionId()); 
    $this->forward404Unless($this->diario);
  }

  public function executeCreate()
  {
    $this->diario = new Diario();

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->diario = DiarioPeer::retrieveByPk($this->getRequestParameter('id'));
    
    $this->profesor = ProfesorPeer::retrieveByPk($this->diario->getProfesorId());
    $this->grupo = GrupoPeer::retrieveByPk($this->diario->getGrupoId());
    $this->asignatura = AsignaturaPeer::retrieveByPk($this->diario->getAsignaturaId());
    $this->evaluacion = EvaluacionPeer::retrieveByPk($this->diario->getEvaluacionId()); 
    $this->forward404Unless($this->diario);
  }

  public function executeUpdateall()
  {

    $c = new Criteria();
    $c->add(DiarioPeer::GRUPO_ID,$this->getRequestParameter('grupoid'));
    $c->add(DiarioPeer::ASIGNATURA_ID,$this->getRequestParameter('asignaturaid'));
    $c->add(DiarioPeer::PROFESOR_ID,$this->getRequestParameter('profesorid'));
    $c->add(DiarioPeer::EVALUACION_ID,$this->getRequestParameter('evaluacionid'));
    $c->addAscendingOrderByColumn(DiarioPeer::FECHA); 
    
    $diarios = DiarioPeer::doSelect($c);
    
    foreach ($diarios as $diario):     
      $diario->setActividad($this->getRequestParameter('actividad'.$diario->getId()));
      if ($this->getRequestParameter('udidactica'.$diario->getId()))
      {
       $diario->setUdidactica($this->getRequestParameter('udidactica'.$diario->getId()));
      }
      if ($this->getRequestParameter('udidactica'.$diario->getId()) == "")
      {
       $diario->setUdidactica(null);
      }
      $diario->save();
    endforeach;
   
    return $this->redirect('diario/listado?fecha='.$this->getRequestParameter('fecha').'&opcion='.$this->getRequestParameter('opcion').'&evaluacion='.$this->getRequestParameter('evaluacionid'));
  }
  
  
  public function executeUpdate()
  {
    if (!$this->getRequestParameter('id'))
    {
      $diario = new Diario();
    }
    else
    {
      $diario = DiarioPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($diario);
    }

    $diario->setId($this->getRequestParameter('id'));
    $diario->setEvaluacionId($this->getRequestParameter('evaluacion_id') ? $this->getRequestParameter('evaluacion_id') : null);
    $diario->setAsignaturaId($this->getRequestParameter('asignatura_id') ? $this->getRequestParameter('asignatura_id') : null);
    $diario->setProfesorId($this->getRequestParameter('profesor_id') ? $this->getRequestParameter('profesor_id') : null);    
    $diario->setGrupoId($this->getRequestParameter('grupo_id') ? $this->getRequestParameter('grupo_id') : null);
    $diario->setFecha($this->getRequestParameter('fecha') ? $this->getRequestParameter('fecha') : null);
    $diario->setActividad($this->getRequestParameter('actividad'));
    if ($this->getRequestParameter('udidactica'))
    {
       $diario->setUdidactica($this->getRequestParameter('udidactica'));
    }
    if ($this->getRequestParameter('udidactica') == "")
      {
       $diario->setUdidactica(null);
      }
    $diario->setActivo($this->getRequestParameter('activo', 0));

    $diario->save();

    return $this->redirect('diario/index?fecha='.strtotime($this->getRequestParameter('fecha')));
  }

  public function executeDelete()
  {
    $diario = DiarioPeer::retrieveByPk($this->getRequestParameter('id'));
    
    $fecha = $diario->getFecha();

    $this->forward404Unless($diario);

    $diario->delete();

    return $this->redirect('diario/index?fecha='.strtotime($fecha));
  }
}
