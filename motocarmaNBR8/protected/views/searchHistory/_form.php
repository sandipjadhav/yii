<?php
/* @var $this SearchHistoryController */
/* @var $model SearchHistory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'search-history-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>


        <?php echo $form->hiddenField($model,'ID'); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'User_ID'); ?>
		 <?php echo $form->dropDownList($model,'User_ID', $model->getAllUsers()); ?>
		<?php echo $form->error($model,'User_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Make'); ?>
		<?php echo $form->textField($model,'Make',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Make'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Model'); ?>
		<?php echo $form->textField($model,'Model',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Model'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Year'); ?>
		<?php echo $form->textField($model,'Year',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Year'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'StyleID'); ?>
		<?php echo $form->textField($model,'StyleID',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'StyleID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MileageCity'); ?>
		<?php echo $form->textField($model,'MileageCity',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'MileageCity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'MileageHighway'); ?>
		<?php echo $form->textField($model,'MileageHighway',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'MileageHighway'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Price'); ?>
		<?php echo $form->textField($model,'Price',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Trim'); ?>
		<?php echo $form->textField($model,'Trim',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Trim'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateAdded'); ?>
		<?php echo $form->textField($model,'DateAdded',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'DateAdded'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->