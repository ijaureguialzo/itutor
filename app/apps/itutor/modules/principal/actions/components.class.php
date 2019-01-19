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
class principalComponents extends sfComponents
{
  /**
   * Executes index action
   *
   */
  public function executeCabecera()
  {
   if ($this->getUser()->isAuthenticated() == true)
   {
       $c = New Criteria();
       $c->add(sfGuardUserPeer::USERNAME, $this->getUser()->getGuardUser()->getUsername());
       $this->usuario = sfGuardUserPeer::doSelectOne($c);  
        
       $this->getUser()->setAttribute('codigo',$this->usuario->getCodigo());
       
       $permisos=$this->getUser()->getPermissions();
       $admin = false; 
       foreach ($permisos as $permiso):
       if ($permiso == "admin")
       {
          $admin = true;
       }
       endforeach;
       if ($this->getUser()->isSuperAdmin() || $admin == true)
       {
          $this->getUser()->setAttribute('nombre',$this->usuario->getNombre());
       }
       else
       {
         $c = new Criteria();
         $c->add(ProfesorPeer::CODIGO, $this->getUser()->getAttribute('codigo'));
         $this->profesor =  ProfesorPeer::doSelectOne ($c);
       
         $this->getUser()->setAttribute('nombre',$this->profesor->getNombre());
       }
                  
   } 
    
  } 
  
   
  public function executeMenu()
  {
       $c = New Criteria();
       $c->add(sfGuardUserPeer::USERNAME, $this->getUser()->getGuardUser()->getUsername());
       $this->usuario = sfGuardUserPeer::doSelectOne($c);  
        
       $this->getUser()->setAttribute('codigo',$this->usuario->getCodigo());


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
         $c = new Criteria();
         $c->add(ProfesorPeer::CODIGO, $this->getUser()->getAttribute('codigo'));
         $this->profesor =  ProfesorPeer::doSelectOne ($c);
         
         $c = new Criteria();
         $c->add(GrupoPeer::PROFESOR_ID,$this->profesor->getId());
         $this->grupo = GrupoPeer::doSelectOne($c);
        }  
  }
  
  
  
  
  public function executeHoras()
  {
   //$this->tutor = $this->getRequestParameter('tutor');
   //$this->asignatura = $this->getRequestParameter('asignatura');
   //$this->profesor;

   $c= new Criteria();

   //if ($this->tutor)
   //{
   //  $this->grupo = $this->getRequestParameter('grupo');
   //  $this->dia = $this->getRequestParameter('dia');

   //  $d= new Criteria();
   //  $d->add(HorarioPeer::GRUPO_ID, $this->grupo);
   //  $d->add(HorarioPeer::DIA, $this->dia);

    // $horario = HorarioPeer::doSelect($d);

     //$grupo = GrupoPeer::retrieveByPK($this->grupo);

     //$c->add(ProfesorPeer::ID, $grupo->getProfesorId());
   //}
   //else if ($this->asignatura)
   if ($this->asignatura)
   {
     //$c->add(FaltaPeer::ASIGNATURA_ID,$this->asignatura);
     //$c->addJoin(FaltaPeer::ASIGNATURA_ID,AsignaturaPeer::ID);
     //$c->addJoin(AsignaturaPeer::PROFESOR_ID,ProfesorPeer::ID);
       $c->addJoin(AsignaturaPeer::PROFESOR_ID,ProfesorPeer::ID);
       $c->add(AsignaturaPeer::ID,$this->asignatura);
       $profesor = ProfesorPeer::doSelectOne($c);

   }
   else
   {
    if ($this->profesor)
    {
        $profesor = ProfesorPeer::retrieveByPK($this->profesor);
    }
    else
    {
        $c->add(ProfesorPeer::CODIGO, $this->getUser()->getAttribute('codigo'));
        $profesor = ProfesorPeer::doSelectOne($c);
    }
   }

   
   
   $d = new Criteria();
   $d->add(HoraperfilPeer::PERFIL_ID,$profesor->getPerfilId());
   $d->addJoin(HoraperfilPeer::HORA_ID,HoraPeer::ID);
   $d->addAscendingOrderByColumn(HoraperfilPeer::ORDEN);
   
   $this->horas = HoraPeer::doSelect($d);


  }
  
  public function executeDias()
  {
  
  }
  
  public function executeMeses()
  {
  
  }
}
