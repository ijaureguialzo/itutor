<?php use_helper('Javascript') ?>
<?php use_helper('Date') ?>
<?php use_helper('I18N') ?>
<?php use_helper('Object') ?>

<div style="float: left;margin-right: 5px;">
<?php
if ($eva_actual)
   {
      $selec = $eva_actual->getId();
   }
   else
   {
     $selec = 0;
   }
echo __('Escoge evaluación') ?> <?php echo select_tag('evaluacion', objects_for_select(
  EvaluacionPeer::doSelect($a),
  'getId',
  'getTitulo',
  $selec
 ))?>
</div>
 <div class="list_alum" style="float: left;">
<?php echo link_to_function(__('Editar'), "enviar()"); ?>
</div>
