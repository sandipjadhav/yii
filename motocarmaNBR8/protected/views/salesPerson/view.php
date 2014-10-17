<?php
/* @var $this SalesPersonController */
/* @var $model SalesPerson */

$this->breadcrumbs=array(
	'Sales People'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List SalesPerson', 'url'=>array('index')),
	array('label'=>'Create SalesPerson', 'url'=>array('create')),
	array('label'=>'Update SalesPerson', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete SalesPerson', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SalesPerson', 'url'=>array('admin')),
);
?>

<h1>View SalesPerson #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		array('name'=>'Dealership', 'value'=>$model->dealership->Name),
		array('name'=>'username', 'value'=>$model->user->username),
		'ContactPhone',
		'Email',
		'Description',
		'DateAdded',
		'Active',
		'Photo',
	),
)); ?>
