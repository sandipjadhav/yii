<?php
/* @var $this DealController */
/* @var $model Deal */

$this->breadcrumbs=array(
	'Deals'=>array('index'),
	$model->ID=>array('view','id'=>$model->ID),
	'Update',
);
$dateFields = array("input[name*='DateAdded']", "input[name*='LastModified']");
Yii::app()->customUtility->addJqueryDatePicker($dateFields);
$this->menu=array(
	array('label'=>'List Deal', 'url'=>array('index')),
	array('label'=>'Create Deal', 'url'=>array('create')),
	array('label'=>'View Deal', 'url'=>array('view', 'id'=>$model->ID)),
	array('label'=>'Manage Deal', 'url'=>array('admin')),
);
?> 

<h1>Update Deal <?php echo $model->ID; ?></h1>

<?php 
if($currentRole == 'salesperson' || $currentRole == 'dealer' ){
    $this->renderPartial('_processDeal', array('model'=>$model));
}else{
    $this->renderPartial('_form', array('model'=>$model)); 
}          
?>