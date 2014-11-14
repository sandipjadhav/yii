<?php
/* @var $this DealController */
/* @var $model Deal */

$this->breadcrumbs=array(
	'Deals'=>array('index'),
	$model->ID,
);
$roles = Rights::getAssignedRoles(Yii::app()->user->Id);
$roleName = strtolower(current($roles)->name);
if($roleName == 'authenticated'){
    $this->menu=array(
            array('label'=>'List Deal', 'url'=>array('index')),
    );    
}else{
    $this->menu=array(
            array('label'=>'List Deal', 'url'=>array('index')),
            array('label'=>'Create Deal', 'url'=>array('create')),
            array('label'=>'Update Deal', 'url'=>array('update', 'id'=>$model->ID)),
            array('label'=>'Delete Deal', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
            array('label'=>'Manage Deal', 'url'=>array('admin')),
    );
}
?>

<h1>View Deal #<?php echo $model->ID; ?></h1>

<?php 
    $salesPerson = '';
    if($model->salesPerson && $model->salesPerson->user && $model->salesPerson->user->profile){
        $salesPerson = $model->salesPerson->user->profile->getAttribute('firstname')." ".$model->salesPerson->user->profile->getAttribute('lastname');
    }
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		array('name' => 'car.Make'),
                array('name'=>'Dealership', 'value'=>$model->dealership->Name),
		array('name'=>'dealStatus.DealStatus'),
		array('name'=>'Sales Person', 'value'=>$salesPerson),
		array('name'=>'username', 'value'=>$model->user->username),
		'Price',
		'DateAdded',
		'LastModified',
	),
)); ?>
