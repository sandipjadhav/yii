<?php
/* @var $this DealHistoryController */
/* @var $model DealHistory */

$this->breadcrumbs=array(
	'Deal Histories'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List DealHistory', 'url'=>array('index')),
	array('label'=>'Create DealHistory', 'url'=>array('create')),
	array('label'=>'Update DealHistory', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete DealHistory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DealHistory', 'url'=>array('admin')),
);
?>

<h1>View DealHistory #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		array('name' => 'car.Make'),
		'Deal_ID',
		array('name'=>'dealStatus.DealStatus'),
		'SalesPerson_ID',
		array(
                    'name' => 'User',
                'header'=>'username',
                'value'=>$model->getRelated('user')->username, //column name, php expression
                'type'=>'raw',
            ),
		'DealStatus',
		'Make',
		'Model',
		'Price',
		'SalesPersonUserName',
		'StyleID',
		'Year',
		'UserName',
	),
)); ?>
