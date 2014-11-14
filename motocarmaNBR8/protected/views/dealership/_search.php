<?php
/* @var $this DealershipController */
/* @var $model Dealership */
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
		<?php echo $form->label($model,'Name'); ?>
		<?php echo $form->textField($model,'Name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Address'); ?>
		<?php echo $form->textField($model,'Address',array('size'=>60,'maxlength'=>1000)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WorkPhone'); ?>
		<?php echo $form->textField($model,'WorkPhone',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'WorkPhone2'); ?>
		<?php echo $form->textField($model,'WorkPhone2',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Fax'); ?>
		<?php echo $form->textField($model,'Fax',array('size'=>15,'maxlength'=>15)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Website'); ?>
		<?php echo $form->textField($model,'Website',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Description'); ?>
		<?php echo $form->textField($model,'Description',array('size'=>60,'maxlength'=>500)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Active'); ?>
		<?php echo $form->checkBox($model,'Active'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateAdded'); ?>
		<?php echo $form->textField($model,'DateAdded'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->