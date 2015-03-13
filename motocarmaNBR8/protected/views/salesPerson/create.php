<?php
/* @var $this SalesPersonController */
/* @var $model SalesPerson */

$this->breadcrumbs=array(
	'Sales People'=>array('index'),
	'Create',
);
$dateFields = array("input[name*='DateAdded']","input[name*='birthday']");
Yii::app()->customUtility->addJqueryDatePicker($dateFields);
$this->menu=array(
	array('label'=>'List SalesPerson', 'url'=>array('index')),
	array('label'=>'Manage SalesPerson', 'url'=>array('admin')),
);
?>

<h1>Create SalesPerson</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'user'=>$user,'profile'=>$profile)); ?>