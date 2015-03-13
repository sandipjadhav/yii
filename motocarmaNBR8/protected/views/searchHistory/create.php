<?php
/* @var $this SearchHistoryController */
/* @var $model SearchHistory */

$this->breadcrumbs=array(
	'Search Histories'=>array('index'),
	'Create',
);
$dateFields = array("input[name*='DateAdded']");
Yii::app()->customUtility->addJqueryDatePicker($dateFields);
$this->menu=array(
	array('label'=>'List SearchHistory', 'url'=>array('index')),
	array('label'=>'Manage SearchHistory', 'url'=>array('admin')),
);
?>

<h1>Create SearchHistory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>