<?php
/* @var $this DealController */
/* @var $data Deal */
?>

<div class="view">

	<b></b>
	<?php echo CHtml::link('View', array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Dealership_ID')); ?>:</b>
        <?php if(!empty($data->dealership)) { echo CHtml::encode($data->dealership->Name); } ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('Car_ID')); ?>:</b>
        <?php echo CHtml::encode($data->car->Make); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DealStatus_ID')); ?>:</b>
	<?php echo CHtml::encode($data->dealStatus->DealStatus); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SalesPerson_ID')); ?>:</b>
	<?php echo CHtml::encode($data->salesPerson->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('User_ID')); ?>:</b>
	<?php echo CHtml::encode($data->user->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Price')); ?>:</b>
	<?php echo CHtml::encode($data->Price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateAdded')); ?>:</b>
	<?php echo CHtml::encode($data->DateAdded); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('LastModified')); ?>:</b>
	<?php echo CHtml::encode($data->LastModified); ?>
	<br />

	*/ ?>

</div>