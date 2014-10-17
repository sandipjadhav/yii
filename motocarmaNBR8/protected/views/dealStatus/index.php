<?php
/* @var $this DealStatusController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Deal Statuses',
);

$this->menu=array(
	array('label'=>'Create DealStatus', 'url'=>array('create')),
	array('label'=>'Manage DealStatus', 'url'=>array('admin')),
);
?>

<h1>Deal Statuses</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
