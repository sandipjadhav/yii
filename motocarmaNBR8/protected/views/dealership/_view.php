<?php
/* @var $this DealershipController */
/* @var $data Dealership */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />
        
        <?php if(!empty($data->user->username)) { ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('User_ID')); ?>:</b>
	<?php echo CHtml::encode($data->user->username); ?>
	<br />
        <?php } ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
	<?php echo CHtml::encode($data->Name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Address')); ?>:</b>
	<?php echo CHtml::encode($data->Address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WorkPhone')); ?>:</b>
	<?php echo CHtml::encode($data->WorkPhone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('WorkPhone2')); ?>:</b>
	<?php echo CHtml::encode($data->WorkPhone2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fax')); ?>:</b>
	<?php echo CHtml::encode($data->Fax); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Website')); ?>:</b>
	<?php echo CHtml::encode($data->Website); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Active')); ?>:</b>
	<?php echo CHtml::encode($data->Active); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Photo')); ?>:</b>
	<?php echo CHtml::encode($data->Photo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateAdded')); ?>:</b>
	<?php echo CHtml::encode($data->DateAdded); ?>
	<br />

	*/ ?>

</div>