<?php
/* @var $this SavedCarsController */
/* @var $data SavedCars */
?>

<div class="view">

	<b></b>
	<?php echo CHtml::link('View', array('view', 'id'=>$data->ID)); ?>
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