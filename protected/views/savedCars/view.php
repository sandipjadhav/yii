<?php
/* @var $this SavedCarsController */
/* @var $model SavedCars */

$this->breadcrumbs=array(
	'Saved Cars'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List SavedCars', 'url'=>array('index')),
	array('label'=>'Create SavedCars', 'url'=>array('create')),
	array('label'=>'Update SavedCars', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete SavedCars', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SavedCars', 'url'=>array('admin')),
);
?>

<h1>View SavedCars #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
                array('name' => 'car.Make'),
                array('name' => 'dealStatus.DealStatus'),
                array(
                    'header'=>'username',
                    'value'=>'$data->getRelated(\'user\')->username', //column name, php expression
                    'type'=>'raw',
                ),
                'DateAdded',
	),
)); ?>
