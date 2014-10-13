<?php
/* @var $this DealController */
/* @var $model Deal */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ID'); ?>
		<?php echo $form->textField($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Dealership_ID'); ?>
		<?php echo $form->textField($model,'Dealership_ID'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'Car_ID'); ?>
		<?php echo $form->textField($model,'Car_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DealStatus_ID'); ?>
		<?php echo $form->textField($model,'DealStatus_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SalesPerson_ID'); ?>
		<?php echo $form->textField($model,'SalesPerson_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'User_ID'); ?>
		<?php echo $form->textField($model,'User_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Price'); ?>
		<?php echo $form->textField($model,'Price',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateAdded'); ?>
		<?php echo $form->textField($model,'DateAdded'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'LastModified'); ?>
		<?php echo $form->textField($model,'LastModified'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->