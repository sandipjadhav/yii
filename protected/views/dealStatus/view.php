<?php
/* @var $this DealStatusController */
/* @var $model DealStatus */

$this->breadcrumbs=array(
	'Deal Statuses'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List DealStatus', 'url'=>array('index')),
	array('label'=>'Create DealStatus', 'url'=>array('create')),
	array('label'=>'Update DealStatus', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete DealStatus', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DealStatus', 'url'=>array('admin')),
);
?>

<h1>View DealStatus #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		'DealStatus',
	),
)); ?>
