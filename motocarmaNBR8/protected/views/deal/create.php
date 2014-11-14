<?php
/* @var $this DealController */
/* @var $model Deal */

$this->breadcrumbs=array(
	'Deals'=>array('index'),
	'Create',
);
$dateFields = array("input[name*='DateAdded']", "input[name*='LastModified']");
Yii::app()->customUtility->addJqueryDatePicker($dateFields);
if($currentRole != 'authenticated'){
$this->menu=array(
	array('label'=>'List Deal', 'url'=>array('index')),
	array('label'=>'Manage Deal', 'url'=>array('admin')),
);
?>
    
<h1>Create Deal</h1>

<?php 

    $this->renderPartial('_form', array('model'=>$model)); 
}else{
    if(Yii::app()->user->hasFlash('error')) {
            echo '<div class="flash-error">' . Yii::app()->user->getFlash('error') . "</div>\n";
        }
    
    $this->renderPartial('_dealWizard', array('model'=>$model,'arrCarInfo'=>$arrCarInfo));
}
?>