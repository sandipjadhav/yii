<?php
/* @var $this CarController */
/* @var $data Car */
?>

<div class="view">

	<b></b>
	<?php echo CHtml::link('View', array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('StyleID')); ?>:</b>
	<?php echo CHtml::encode($data->StyleID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Price')); ?>:</b>
	<?php echo CHtml::encode($data->Price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Make')); ?>:</b>
	<?php echo CHtml::encode($data->Make); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Model')); ?>:</b>
	<?php echo CHtml::encode($data->Model); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Year')); ?>:</b>
	<?php echo CHtml::encode($data->Year); ?>
	<br />


</div>