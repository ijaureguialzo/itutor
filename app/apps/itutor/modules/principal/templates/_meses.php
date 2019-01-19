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
      switch ($mes)
      {
        case 1: 
          echo __('Enero');
          break;
        case 2:
          echo __('Febrero');
          break;
        case 3:
          echo __('Marzo');
          break;
        case 4:
          echo __('Abril');
          break;
        case 5:
          echo __('Mayo');
          break;
        case 6:
          echo __('Junio');
          break;
        case 7:
          echo __('Julio');
          break;
        case 8:
          echo __('Agosto');
          break;
        case 9:
          echo __('Septiembre');
          break;
        case 10:
          echo __('Octubre');
          break;
        case 11:
          echo __('Noviembre');
          break;
        case 12:
          echo __('Diciembre');
          break;
      }
?> 