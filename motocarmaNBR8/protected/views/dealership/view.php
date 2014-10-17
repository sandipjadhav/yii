<?php
/* @var $this DealershipController */
/* @var $model Dealership */

$this->breadcrumbs=array(
	'Dealerships'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List Dealership', 'url'=>array('index')),
	array('label'=>'Create Dealership', 'url'=>array('create')),
	array('label'=>'Update Dealership', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Dealership', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Dealership', 'url'=>array('admin')),
);
?>

<h1>View Dealership #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		array('name'=>'username', 'value'=>$model->user->username),
		'Name',
		'Address',
		'Email',
		'WorkPhone',
		'WorkPhone2',
		'Fax',
		'Website',
		'Description',
		'Active',
		'Photo',
		'DateAdded',
	),
)); ?>
