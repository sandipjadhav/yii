<?php
/* @var $this CarController */
/* @var $model Car */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'car-form',
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
		<?php echo $form->labelEx($model,'StyleID'); ?>
		<?php echo $form->textField($model,'StyleID',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'StyleID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Price'); ?>
		<?php echo $form->textField($model,'Price',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'Price'); ?>
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

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->