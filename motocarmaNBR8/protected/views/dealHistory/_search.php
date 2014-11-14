<?php
/* @var $this DealHistoryController */
/* @var $model DealHistory */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	
	<div class="row">
		<?php echo $form->label($model,'Car_ID'); ?>
                <?php echo $form->dropDownList($model,'Car_ID', $model->getAllCars(), array('empty'=>'Select')); ?>
	</div>

	<!--div class="row">
		<?php echo $form->label($model,'Deal_ID'); ?>
		<?php echo $form->textField($model,'Deal_ID'); ?>
	</div-->

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

	<!--div class="row">
		<?php echo $form->label($model,'DealStatus'); ?>
		<?php echo $form->textField($model,'DealStatus',array('size'=>45,'maxlength'=>45)); ?>
	</div-->

	<div class="row">
		<?php echo $form->label($model,'Make'); ?>
                <?php echo $form->dropDownList($model,'Make', $model->getAllCars('Make','Make',true), array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Model'); ?>
                <?php echo $form->dropDownList($model,'Model', $model->getAllCars('Model','Model',true), array('empty'=>'Select')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Price'); ?>
		<?php echo $form->textField($model,'Price',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<!--div class="row">
		<?php echo $form->label($model,'SalesPersonUserName'); ?>
		<?php echo $form->textField($model,'SalesPersonUserName',array('size'=>45,'maxlength'=>45)); ?>
	</div-->

	<div class="row">
		<?php echo $form->label($model,'StyleID'); ?>
		<?php echo $form->textField($model,'StyleID',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Year'); ?>
                <?php $yRange = range(date('Y')-10,date('Y'));
                $year = array_combine($yRange,$yRange);?>
		<?php echo $form->dropDownList($model,'Year',$year, array('empty'=>'Select')); ?>
	</div>

	<!--div class="row">
		<?php echo $form->label($model,'UserName'); ?>
		<?php echo $form->textField($model,'UserName',array('size'=>45,'maxlength'=>45)); ?>
	</div-->

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->