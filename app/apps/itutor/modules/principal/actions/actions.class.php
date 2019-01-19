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
 * principal actions.
 *
 * @package    gesal
 * @subpackage principal
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class principalActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
   $i = $this->getRequestParameter('i');
	 if( $i == 'es' || $i == 'eu' )
	 {   
   	$this->getUser()->setCulture($i);
   }
  	
   if (!$this->getUser()->isAuthenticated() == true)
   {
    $this->forward('sfGuardAuth','signin');   
   }
   else
   {
   
       $permisos=$this->getUser()->getPermissions();
       $this->admin = false; 
       foreach ($permisos as $permiso):
       if ($permiso == "admin")
       {
          $this->admin = true;
       }
       endforeach; 
       
       if (!$this->getUser()->isSuperAdmin() && $this->admin == false)
       {
         $c = New Criteria();
         $c->add(sfGuardUserPeer::USERNAME, $this->getUser()->getGuardUser()->getUsername());
         $this->usuario = sfGuardUserPeer::doSelectOne($c);  
       
         $c = new Criteria();
         $c->add(ProfesorPeer::CODIGO, $this->usuario->getCodigo());
         $this->profesor =  ProfesorPeer::doSelectOne ($c);
        
         $c = new Criteria();
         $c->add(GrupoPeer::PROFESOR_ID,$this->profesor->getId());
         $this->grupo = GrupoPeer::doSelectOne($c);
      
        
        $horas = HoraPeer::doSelect(new Criteria());
        
        if (count($horas) > 0)
        {
          $this->getUser()->setAttribute('horas',true);        
        }
        else
        {
          $this->getUser()->setAttribute('horas',false);
        }
        
        $c = new Criteria();
        $c->add(AsignaturaPeer::PROFESOR_ID,$this->profesor->getId());
        $asignaturas = AsignaturaPeer::doSelect($c);
        
        if (count($asignaturas) > 0)
        {
          $this->getUser()->setAttribute('asignaturas',true);        
        }
        else
        {
          $this->getUser()->setAttribute('asignaturas',false);
        }
        
        $c->add(HorarioPeer::PROFESOR_ID,$this->profesor->getId());
        $horario = HorarioPeer::doSelect($c);
        
        if (count($horario) > 0)
        {
          $this->getUser()->setAttribute('horario',true);        
        }
        else
        {
          $this->getUser()->setAttribute('horario',false);
        }
        }
   }      
  
  }
  
  public function executeError()
  {
    $this->mensaje = $this->getRequestParameter('mensaje');  
  }
  
  public function executeWarning()
  {
    $error = $this->getRequestParameter('error');
    
    if ($error == 1)
    {
      $this->mensaje = "No puede haber pruebas que tengan como porcentaje 100 y menos de 100 al mismo tiempo.";   
    } 
    if ($error == 2)
    {
      $this->mensaje = "La suma de los porcentajes de las pruebas debe ser 100.";   
    }  
  }
  

  public function executeLogout()
  {
    // Desconectar al usuario
    if ($this->getUser()->isAuthenticated())
    {
      $this->getUser()->getAttributeHolder()->clear();
      $this->getUser()->setAuthenticated(false);
      $this->redirect('/');
    }
  } 
}
