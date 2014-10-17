<?php
/* @var $this SearchHistoryController */
/* @var $model SearchHistory */

$this->breadcrumbs=array(
	'Search Histories'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List SearchHistory', 'url'=>array('index')),
	array('label'=>'Create SearchHistory', 'url'=>array('create')),
	array('label'=>'Update SearchHistory', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete SearchHistory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SearchHistory', 'url'=>array('admin')),
);
?>

<h1>View SearchHistory #<?php echo $model->ID; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		/*array(
                    'header'=>'username',
                    'value'=>'$data->getRelated(\'user\')->username', //column name, php expression
                    'type'=>'raw',
                ),*/
                //array('name'=>'username', 'value'=>'$data->user->username', 'header'=>'User Name'),
                array('name'=>'username', 'value'=>$model->user->username),	
                'Make',
		'Model',
		'Year',
		'StyleID',
		'MileageCity',
		'MileageHighway',
		'Price',
		'Trim',
		'DateAdded',
	),
)); ?>
