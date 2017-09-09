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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
  "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" >
<head>

<?php include_http_metas() ?>
<?php include_metas() ?>

<?php include_title() ?>



<link rel="shortcut icon" href="/itutor/favicon.ico" />

<link rel="stylesheet" type="text/css" media="print" href="/itutor/css/imprimir.css" />

</head>
<body>
<div id="frame">
	<div id="topnav">
	  <div id="nav" style="float: right;">
    <?php     
    if ($sf_user->isAuthenticated() == true) 
	  {
	  include_component('principal','menu');
	  }
	  ?>
	  </div>
	  <div id="logo">
		<?php echo link_to(image_tag('/images/logo2.png','style="margin-top:2px;margin-left:15px;"'),'principal/index'); ?>
         </div>
	</div>   
	<div id="wrapper">
	<?php
	if ($sf_user->isAuthenticated() == true) 
	{  
 include_component('principal','cabecera');
 }
 ?>    
      <?php echo $sf_data->getRaw('sf_content') ?>
		  <div id ="footer" style="width:100%;clear:both;text-align:center;">
        <div style="width:100%;border-bottom: 1px solid black;height:2em;"></div>	      
	      <p>Copyright &copy; 2010 Oihane García Bolumburu. Distribuido bajo la <?php echo link_to('licencia GNU GPL','http://www.gnu.org/licenses/gpl.html'); ?>.</p>
      </div>    
	</div>
</div>
</body>
</html>
