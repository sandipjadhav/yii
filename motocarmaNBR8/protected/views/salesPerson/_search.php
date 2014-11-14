<?php
/* @var $this SalesPersonController */
/* @var $model SalesPerson */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php 
$dateFields = array("input[name*='DateAdded']");
Yii::app()->customUtility->addJqueryDatePicker($dateFields);

$form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>


	<div class="row">
		<?php echo $form->label($model,'Dealership_ID'); ?>
		<?php echo $form->dropDownList($model,'Dealership_ID', $model->getAllDealerships(), array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'User_ID'); ?>
                <?php echo $form->dropDownList($model,'User_ID', $model->getAllUsers(), array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ContactPhone'); ?>
		<?php echo $form->textField($model,'ContactPhone',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateAdded'); ?>
		<?php echo $form->textField($model,'DateAdded'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Active'); ?>
		<?php echo $form->checkBox($model,'Active'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->