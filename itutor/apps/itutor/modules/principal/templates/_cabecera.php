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
<?php use_helper('Validation', 'I18N') ?>
   <div id="menu_principal">	  
	  <ul id="menu_principal_lista">
	    <li><?php echo $sf_user->getAttribute('nombre'); ?></li>
      <?php 
      $permisos=$sf_user->getPermissions();
      $admin = false; 
      foreach ($permisos as $permiso):
       if ($permiso == "admin")
       {
          $admin = true;
       }
      endforeach; 
      ?> 
      <li><?php echo link_to(image_tag('/images/banderas/eu.png'),'principal/index?i=eu') ?></li> 
      <li><?php echo link_to(image_tag('/images/banderas/es.png'),'principal/index?i=es') ?></li>
      <li><?php echo link_to(__('Salir'),'principal/logout') ?></li>
	  </ul>
	      
	  </div> 