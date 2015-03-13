<?php
/* @var $this DealController */
/* @var $data Deal */
?>

<div class="view">


    <b></b>
    <?php
    if ($data->DealStatus_ID == 1) {
        echo CHtml::link('View Deal', array('view', 'id' => $data->ID));
    } else {
        echo CHtml::link('Deal Dashboard', array('update', 'id' => $data->ID));
    }?>
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