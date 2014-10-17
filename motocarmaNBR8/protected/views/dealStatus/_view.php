<?php
/* @var $this DealStatusController */
/* @var $data DealStatus */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DealStatus')); ?>:</b>
	<?php echo CHtml::encode($data->DealStatus); ?>
	<br />


</div>