<?php
/* @var $this SearchHistoryController */
/* @var $data SearchHistory */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ID')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ID), array('view', 'id'=>$data->ID)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('User_ID')); ?>:</b>
	<?php echo CHtml::encode($data->user->username); ?>
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

	<b><?php echo CHtml::encode($data->getAttributeLabel('StyleID')); ?>:</b>
	<?php echo CHtml::encode($data->StyleID); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('MileageCity')); ?>:</b>
	<?php echo CHtml::encode($data->MileageCity); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('MileageHighway')); ?>:</b>
	<?php echo CHtml::encode($data->MileageHighway); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Price')); ?>:</b>
	<?php echo CHtml::encode($data->Price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Trim')); ?>:</b>
	<?php echo CHtml::encode($data->Trim); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateAdded')); ?>:</b>
	<?php echo CHtml::encode($data->DateAdded); ?>
	<br />

	*/ ?>

</div>