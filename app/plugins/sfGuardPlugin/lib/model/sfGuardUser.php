<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUser.php 7633 2008-02-27 17:54:50Z fabien $
 */
class sfGuardUser extends PluginsfGuardUser
{

  public function getProfesor()
  {
    $permisos=$this->getPermissions();
    $this->admin = false; 
    foreach ($permisos as $permiso):
    if ($permiso == "admin")
    {
       $this->admin = true;
    }
    endforeach; 
       
    if (!$this->getIsSuperAdmin() && $this->admin == false)
    {
    $cadena = '';
    $cadena = $cadena .link_to(__('Asignar profesor'),'profesor/create?codigo='.$this->getCodigo().'&nombre='.$this->getNombre());
    return $cadena;
    }
  }
}
