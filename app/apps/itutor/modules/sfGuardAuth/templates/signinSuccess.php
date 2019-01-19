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
      <li><?php echo __('Escoge idioma'); ?></li> 
      <li><?php echo link_to(image_tag('/images/banderas/es.png'),'principal/index?i=es') ?></li>
      <li><?php echo link_to(image_tag('/images/banderas/eu.png'),'principal/index?i=eu') ?></li> 
  </ul>
	</div> 
<div id="contenedor" style="text-align: center; width: 100%;">
<div style="width: 435px; margin: 10px auto 0; text-align: center;"> 
<?php echo form_tag('@sf_guard_signin') ?>

  <fieldset style="padding: 15px;width: 400px;border: 1px solid #aaa; background-color: #ddd;">
    <div style="float: left;"><?php echo image_tag('/images/iconos/candado.png'); ?></div>
    <div style="float: left;">
    <div id="sf_guard_auth_username" style="width: 275px;text-align: right;margin-right: 15px;padding-bottom: 5px;">
      <?php
      echo form_error('username'), 
      label_for('username', __('username:').'&nbsp;', 'style="font-weight: bold;"'),
      input_tag('username', $sf_data->get('sf_params')->get('username')); 
      ?>
    </div>

    <div id="sf_guard_auth_password" style="width: 275px;text-align: right;margin-right: 15px;padding-bottom: 10px;">
      <?php 
      echo form_error('password'), 
        label_for('password', __('password:').'&nbsp;', 'style="font-weight: bold;"'),
        input_password_tag('password');
      ?>
    </div>
<?php /*
    <div id="sf_guard_auth_remember" style="width: 275px;text-align: right;margin-right: 15px;padding-bottom: 5px;">
      <?php
      echo label_for('remember', __('Remember me?').'&nbsp;', 'style="font-weight: bold;"'),
      checkbox_tag('remember');
      ?>
    </div>
*/ ?>
    <div style="width: 275px;text-align: right;margin-right: 15px;padding-bottom: 5px;"> 
     <?php 
     echo submit_tag(__('sign in')) 
     ?>
     </div>
     </div>
  </fieldset>
  
  <?php /* 
  echo submit_tag(__('sign in')), 
  link_to(__('Forgot your password?'), '@sf_guard_password', array('id' => 'sf_guard_auth_forgot_password')) 
  */?>
</form>
</div>
</div> 

