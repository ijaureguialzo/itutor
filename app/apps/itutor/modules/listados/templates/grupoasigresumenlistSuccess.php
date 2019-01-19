<?php use_helper('Javascript') ?>
<?php use_helper('Date') ?> 
<?php use_helper('I18N') ?>
<?php use_helper('Object') ?>

<div style="float: left;margin-right: 5px;">
<?php echo __('Escoge grupo') ?> <?php echo select_tag('grupo_id', objects_for_select(
  GrupoPeer::doSelect($c),
  'getId',
  'getNombre',
  0
 ))?>

</div>
 <div class="list_alum" style="float: left;">
<?php echo link_to_function(__('Listado'), "enviar3()"); ?>
</div>