<?php
/* @var $this SavedCarsController */
/* @var $model SavedCars */

$this->breadcrumbs=array(
	'Saved Cars'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);
$dateFields = array("input[name*='DateAdded']");
Yii::app()->customUtility->addJqueryDatePicker($dateFields);
$this->menu=array(
	array('label'=>'List SavedCars', 'url'=>array('index')),
	array('label'=>'Create SavedCars', 'url'=>array('create')),
	array('label'=>'View SavedCars', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage SavedCars', 'url'=>array('admin')),
);
?>

<h1>Update SavedCars <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>