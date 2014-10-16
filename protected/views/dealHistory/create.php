<?php
/* @var $this DealHistoryController */
/* @var $model DealHistory */

$this->breadcrumbs=array(
	'Deal Histories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DealHistory', 'url'=>array('index')),
	array('label'=>'Manage DealHistory', 'url'=>array('admin')),
);
?>

<h1>Create DealHistory</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>