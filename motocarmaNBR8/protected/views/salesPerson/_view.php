<?php
/* @var $this SalesPersonController */
/* @var $data SalesPerson */
?>

<div class="view">

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('Dealership_ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->dealership->Name), array('view', 'id'=>$data->ID));; ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('User_ID')); ?>:</b>
	<?php echo CHtml::encode($data->user->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ContactPhone')); ?>:</b>
	<?php echo CHtml::encode($data->ContactPhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->user->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateAdded')); ?>:</b>
	<?php echo CHtml::encode($data->DateAdded); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Active')); ?>:</b>
	<?php echo CHtml::encode($data->Active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Photo')); ?>:</b>
	<?php echo CHtml::encode($data->Photo); ?>
	<br />

	*/ ?>

</div>