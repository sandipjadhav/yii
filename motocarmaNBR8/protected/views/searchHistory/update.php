<?php
/* @var $this SearchHistoryController */
/* @var $model SearchHistory */

$this->breadcrumbs=array(
	'Search Histories'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);
$dateFields = array("input[name*='DateAdded']");
Yii::app()->customUtility->addJqueryDatePicker($dateFields);
$this->menu=array(
	array('label'=>'List SearchHistory', 'url'=>array('index')),
	array('label'=>'Create SearchHistory', 'url'=>array('create')),
	array('label'=>'View SearchHistory', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage SearchHistory', 'url'=>array('admin')),
);
?>

<h1>Update SearchHistory <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>