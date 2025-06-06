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
// date: 2008/03/07 14:27:42
?>
<?php

/**
 * profesor actions.
 *
 * @package    gesal
 * @subpackage profesor
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 3335 2007-01-23 16:19:56Z fabien $
 */
class profesorActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('profesor', 'list');
  }

  public function executeList()
  {
    $this->profesors = ProfesorPeer::doSelect(new Criteria());
    
    $this->perfiles = PerfilPeer::doSelect(new Criteria());
  }

  public function executeShow()
  {
    $this->profesor = ProfesorPeer::retrieveByPk($this->getRequestParameter('id'));
    
    $c = new Criteria();
    $c->add(PerfilPeer::ID,$this->profesor->getPerfilId());
    $this->perfil = PerfilPeer::doSelectOne($c);
    
    $this->forward404Unless($this->profesor);
  }

  public function executeCreate()
  {
    $c = new Criteria();
    $c->add(ProfesorPeer::CODIGO,$this->getRequestParameter('codigo'));
    $this->profesor = ProfesorPeer::doSelectOne($c);
    
    if ($this->profesor)
    {
      return $this->redirect('profesor/show?id='.$this->profesor->getId()); 
    }
    else 
    { 
      $this->profesor = new Profesor();
      $this->profesor->setCodigo($this->getRequestParameter('codigo'));
      $this->profesor->setNombre($this->getRequestParameter('nombre'));
      $this->setTemplate('edit');
    }
    
  }

  public function executeEdit()
  {
    $this->profesor = ProfesorPeer::retrieveByPk($this->getRequestParameter('id'));
    
        
    $this->forward404Unless($this->profesor);
  }

  public function executeUpdate()
  {
  if (!$this->getRequestParameter('codigo'))
   {
      $mensaje = 'No se puede crear un profesor sin código.';     
      return $this->redirect('principal/error?mensaje='.$mensaje);
   }
   else
   {
    if (!$this->getRequestParameter('perfil_id'))
    {
      $mensaje = 'No se puede crear un profesor sin perfil.';        
      return $this->redirect('principal/error?mensaje='.$mensaje);
    }
    else
    {
    if (!$this->getRequestParameter('id'))
    {
      $profesor = new Profesor();
    }
    else
    {
      $profesor = ProfesorPeer::retrieveByPk($this->getRequestParameter('id'));
      $this->forward404Unless($profesor);
    }

    $profesor->setId($this->getRequestParameter('id'));
    $profesor->setNombre($this->getRequestParameter('nombre'));
    $profesor->setCodigo($this->getRequestParameter('codigo'));
    $profesor->setPerfilId($this->getRequestParameter('perfil_id'));
    $profesor->setEmail($this->getRequestParameter('email'));
    $profesor->setActivo($this->getRequestParameter('activo', 0));

    $profesor->save();

    return $this->redirect('profesor/list');
    }
   }
  }

  public function executeDelete()
  {
    $profesor = ProfesorPeer::retrieveByPk($this->getRequestParameter('id'));
    
    $c = new Criteria();
    $c->add(GrupoPeer::PROFESOR_ID,$profesor->getId());
    $grupos = GrupoPeer::doSelect($c);
    
    $c = new Criteria();
    $c->add(sfGuardUserPeer::CODIGO,$profesor->getCodigo());
    $usuario = sfGuardUserPeer::doSelectOne($c);
    
    $this->forward404Unless($profesor);
    
    if (count($grupos) == 0)
    {
      if($usuario)
      {
        $usuario->delete();
      }
     $profesor->delete();

     return $this->redirect('profesor/list');
    }
    else
    {
       $mensaje = 'No se puede eliminar el profesor porque es tutor de algún grupo.';     
       return $this->redirect('principal/error?mensaje='.$mensaje);
    }   
  }
}
