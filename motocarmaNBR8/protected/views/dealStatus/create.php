<?php
/* @var $this DealStatusController */
/* @var $model DealStatus */

$this->breadcrumbs=array(
	'Deal Statuses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DealStatus', 'url'=>array('index')),
	array('label'=>'Manage DealStatus', 'url'=>array('admin')),
);
?>

<h1>Create DealStatus</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>