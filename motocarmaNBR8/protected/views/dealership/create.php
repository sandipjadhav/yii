<?php
/* @var $this DealershipController */
/* @var $model Dealership */

$this->breadcrumbs=array(
	'Dealerships'=>array('index'),
	'Create',
);
$dateFields = array("input[name*='DateAdded']");
Yii::app()->customUtility->addJqueryDatePicker($dateFields);
$this->menu=array(
	array('label'=>'List Dealership', 'url'=>array('index')),
	array('label'=>'Manage Dealership', 'url'=>array('admin')),
);
?>

<h1>Create Dealership</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>