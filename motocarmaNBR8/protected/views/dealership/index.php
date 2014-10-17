<?php
/* @var $this DealershipController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Dealerships',
);

$this->menu=array(
	array('label'=>'Create Dealership', 'url'=>array('create')),
	array('label'=>'Manage Dealership', 'url'=>array('admin')),
);
?>

<h1>Dealerships</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
