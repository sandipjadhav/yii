<?php
/* @var $this SavedCarsController */
/* @var $data SavedCars */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Car_ID')); ?>:</b>
	<?php echo CHtml::encode($data->car->Make); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DealStatus_ID')); ?>:</b>
	<?php echo CHtml::encode($data->dealStatus->DealStatus); ?>
	<br />

        <b><?php echo CHtml::encode($data->getAttributeLabel('User_ID')); ?>:</b>
	<?php echo CHtml::encode($data->user->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateAdded')); ?>:</b>
	<?php echo CHtml::encode($data->DateAdded); ?>
	<br />


</div>