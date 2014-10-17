<?php
/* @var $this DealStatusController */
/* @var $model DealStatus */

$this->breadcrumbs=array(
	'Deal Statuses'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);

$this->menu=array(
	array('label'=>'List DealStatus', 'url'=>array('index')),
	array('label'=>'Create DealStatus', 'url'=>array('create')),
	array('label'=>'View DealStatus', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage DealStatus', 'url'=>array('admin')),
);
?>

<h1>Update DealStatus <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>