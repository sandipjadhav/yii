<?php
/* @var $this SearchHistoryController */
/* @var $model SearchHistory */
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
		<?php echo $form->label($model,'User_ID'); ?>
                <?php echo $form->dropDownList($model,'User_ID', $model->getAllUsers(), array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Make'); ?>
		<?php echo $form->textField($model,'Make',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Model'); ?>
		<?php echo $form->textField($model,'Model',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Year'); ?>
		<?php echo $form->textField($model,'Year',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'StyleID'); ?>
		<?php echo $form->textField($model,'StyleID',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MileageCity'); ?>
		<?php echo $form->textField($model,'MileageCity',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'MileageHighway'); ?>
		<?php echo $form->textField($model,'MileageHighway',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Price'); ?>
		<?php echo $form->textField($model,'Price',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Trim'); ?>
		<?php echo $form->textField($model,'Trim',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'DateAdded'); ?>
		<?php echo $form->textField($model,'DateAdded',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->