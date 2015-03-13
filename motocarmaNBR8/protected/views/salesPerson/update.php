<?php
/* @var $this SalesPersonController */
/* @var $model SalesPerson */

$this->breadcrumbs=array(
	'Sales People'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);
$dateFields = array("input[name*='DateAdded']","input[name*='birthday']");
Yii::app()->customUtility->addJqueryDatePicker($dateFields);
$this->menu=array(
	array('label'=>'List SalesPerson', 'url'=>array('index')),
	array('label'=>'Create SalesPerson', 'url'=>array('create')),
	array('label'=>'View SalesPerson', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage SalesPerson', 'url'=>array('admin')),
);
?>

<h1>Update SalesPerson <?php echo $model->ID; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'user'=>$user,'profile'=>$profile)); ?>