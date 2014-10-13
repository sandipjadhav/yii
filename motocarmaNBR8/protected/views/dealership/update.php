<?php
/* @var $this DealershipController */
/* @var $model Dealership */

$this->breadcrumbs=array(
	'Dealerships'=>array('index'),
	$model->Name=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List Dealership', 'url'=>array('index')),
	array('label'=>'Create Dealership', 'url'=>array('create')),
	array('label'=>'View Dealership', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Dealership', 'url'=>array('admin')),
);
?>

<h1>Update Dealership <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>