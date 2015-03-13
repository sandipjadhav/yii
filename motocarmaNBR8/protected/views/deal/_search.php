<?php
/* @var $this DealController */
/* @var $model Deal */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php 
$dateFields = array("input[name*='DateAdded']","input[name*='LastModified']");
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
		<?php echo $form->label($model,'Car_ID'); ?>
                <?php echo $form->dropDownList($model,'Car_ID', $model->getAllCars(), array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DealStatus_ID'); ?>
		<?php echo $form->dropDownList($model,'DealStatus_ID', $model->getAllDealStatus(), array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SalesPerson_ID'); ?>
		<?php echo $form->dropDownList($model,'SalesPerson_ID', $model->getAllSalespersons(), array('empty'=>'Select')); ?>
        </div>

	<div class="row">
		<?php echo $form->label($model,'User_ID'); ?>
                <?php echo $form->dropDownList($model,'User_ID', $model->getAllUsers(), array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Price'); ?>
		<?php echo $form->textField($model,'Price',array('size'=>20,'maxlength'=>20)); ?>
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