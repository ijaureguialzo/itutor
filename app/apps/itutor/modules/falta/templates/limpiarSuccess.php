<?php use_helper('Javascript') ?>
<?php
   $vis = "imagen".$alumno->getId()."('visible')";
   $oc = "imagen".$alumno->getId()."('hidden')";
   ?>
   <td><img src="/images/iconos/camera_small.png" onmouseover="<?php echo $vis; ?>" onmouseout="<?php echo $oc; ?>" /><?php echo $alumno->getNombre() ?>
       <div id="im<?php echo $alumno->getId();?>" style="visibility:hidden;position:absolute;">
           <?php $ruta="/images/grupos/".$alumno->getGrupoId()."/".$alumno->getId().".jpg";?>
           <img src="<?php echo $ruta?>" />
       </div>
   </td>
<td><?php 
echo radiobutton_tag('falta'.$alumno->getId(), 1 , false);
echo "</td>";
echo "<td>";
echo radiobutton_tag('falta'.$alumno->getId(), 2 , false);
?>
</td>
<td><?php
echo checkbox_tag('justificado'.$alumno->getId(), true, false);
echo "</td>"; 
echo "<td>";
echo textarea_tag('observaciones'.$alumno->getId(), '', 'size=20x1'); 
?>
</td>
<td>
<div class="cancel"> 
<?php echo 
   link_to_remote('Limpiar', array(
     'update' => $alumno->getId(),
     'url' => 'falta/limpiar?id='.$alumno->getId()
     ))?>
</div>
</td>