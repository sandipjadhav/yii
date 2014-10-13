<?php
/* @var $this DealHistoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Deal Histories',
);

$this->menu=array(
	array('label'=>'Create DealHistory', 'url'=>array('create')),
	array('label'=>'Manage DealHistory', 'url'=>array('admin')),
);
?>

<h1>Deal Histories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
