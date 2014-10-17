<?php
/* @var $this SavedCarsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Saved Cars',
);

$this->menu=array(
	array('label'=>'Create SavedCars', 'url'=>array('create')),
	array('label'=>'Manage SavedCars', 'url'=>array('admin')),
);
?>

<h1>Saved Cars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
