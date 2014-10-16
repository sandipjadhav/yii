<?php
/* @var $this SearchHistoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Search Histories',
);

$this->menu=array(
	array('label'=>'Create SearchHistory', 'url'=>array('create')),
	array('label'=>'Manage SearchHistory', 'url'=>array('admin')),
);
?>

<h1>Search Histories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
