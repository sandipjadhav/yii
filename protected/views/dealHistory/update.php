<?php
/* @var $this DealHistoryController */
/* @var $model DealHistory */

$this->breadcrumbs=array(
	'Deal Histories'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List DealHistory', 'url'=>array('index')),
	array('label'=>'Create DealHistory', 'url'=>array('create')),
	array('label'=>'View DealHistory', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage DealHistory', 'url'=>array('admin')),
);
?>

<h1>Update DealHistory <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>