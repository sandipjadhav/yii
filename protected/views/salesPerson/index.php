<?php
/* @var $this SalesPersonController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Sales People',
);

$this->menu=array(
	array('label'=>'Create SalesPerson', 'url'=>array('create')),
	array('label'=>'Manage SalesPerson', 'url'=>array('admin')),
);
?>

<h1>Sales People</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
