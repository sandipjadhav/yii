<?php
/* @var $this SavedCarsController */
/* @var $model SavedCars */
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
		<?php echo $form->label($model,'Car_ID'); ?>
                <?php echo $form->dropDownList($model,'Car_ID', $model->getAllCars(), array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DealStatus_ID'); ?>
		<?php echo $form->dropDownList($model,'DealStatus_ID', $model->getAllDealStatus(), array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'User_ID'); ?>
                <?php echo $form->dropDownList($model,'User_ID', $model->getAllUsers(), array('empty'=>'Select')); ?>
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