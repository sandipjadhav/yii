<?php
/* @var $this DealController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Deals',
);
$roles = Rights::getAssignedRoles(Yii::app()->user->Id);
$roleName = strtolower(current($roles)->name);
if($roleName != 'authenticated'){
    $this->menu=array(
            array('label'=>'Create Deal', 'url'=>array('create')),
            array('label'=>'Manage Deal', 'url'=>array('admin')),
    );    
}
?>

<h1>Deals</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
