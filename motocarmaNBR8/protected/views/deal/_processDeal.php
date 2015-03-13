<?php
/* @var $this DealController */
/* @var $model Deal */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'deal-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
        <?php echo $form->hiddenField($model,'ID'); ?>
	<?php echo $form->hiddenField($model,'Car_ID'); ?>
        <?php echo $form->hiddenField($model,'User_ID'); ?>
	<?php echo $form->hiddenField($model,'DateAdded'); ?>
	<?php echo $form->hiddenField($model,'LastModified'); ?>
	<?php echo $form->hiddenField($model,'Dealership_ID'); ?>
	<?php echo $form->hiddenField($model,'Car_ID'); ?>
	<?php echo $form->hiddenField($model,'SalesPerson_ID'); ?>
        <?php echo $form->hiddenField($model,'Update_Purpose',array('value'=>'process')); ?>
	
	<div class="row">
		<?php echo $form->labelEx($model,'DealStatus_ID'); ?>
                <?php echo $form->dropDownList($model,'DealStatus_ID', $model->getAllDealStatus()); ?>
		<?php echo $form->error($model,'DealStatus_ID'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Price'); ?>
		<?php echo $form->textField($model,'Price',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Price'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->