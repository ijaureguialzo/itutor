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
<?php use_helper('I18N') ?>
<?php 
      switch ($dia)
      {
        case 1: 
          echo __('Lunes');
          break;
        case 2:
          echo __('Martes');
          break;
        case 3:
          echo __('Miércoles');
          break;
        case 4:
          echo __('Jueves');
          break;
        case 5:
          echo __('Viernes');
          break;
      }
?> 