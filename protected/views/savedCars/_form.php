<?php
/* @var $this SavedCarsController */
/* @var $model SavedCars */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'saved-cars-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ID'); ?>
		<?php echo $form->textField($model,'ID'); ?>
		<?php echo $form->error($model,'ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Car_ID'); ?>
		<?php echo $form->dropDownList($model,'Car_ID', $model->getAllCars()); ?>
		<?php echo $form->error($model,'Car_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DealStatus_ID'); ?>
                <?php echo $form->dropDownList($model,'DealStatus_ID', $model->getAllDealStatus()); ?>
		<?php echo $form->error($model,'DealStatus_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'User_ID'); ?>
		 <?php echo $form->dropDownList($model,'User_ID', $model->getAllUsers()); ?>
		<?php echo $form->error($model,'User_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DateAdded'); ?>
		<?php echo $form->textField($model,'DateAdded'); ?>
		<?php echo $form->error($model,'DateAdded'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->