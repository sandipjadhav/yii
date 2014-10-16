<?php
/* @var $this SavedCarsController */
/* @var $model SavedCars */

$this->breadcrumbs=array(
	'Saved Cars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SavedCars', 'url'=>array('index')),
	array('label'=>'Manage SavedCars', 'url'=>array('admin')),
);
?>

<h1>Create SavedCars</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>