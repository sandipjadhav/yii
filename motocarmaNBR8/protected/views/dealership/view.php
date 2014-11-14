<?php
/* @var $this DealershipController */
/* @var $model Dealership */

$this->breadcrumbs=array(
	'Dealerships'=>array('index'),
	$model->Name,
);

$this->menu=array(
	array('label'=>'List Dealership', 'url'=>array('index')),
	array('label'=>'Create Dealership', 'url'=>array('create')),
	array('label'=>'Update Dealership', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete Dealership', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Dealership', 'url'=>array('admin')),
);
?>

<h1>View Dealership #<?php echo $model->ID; ?></h1>

<?php 
    
	$attributes= array(
		array('name'=>'username', 'value'=>$model->user->username),
		'Name',
		'Address',
		'Email',
		'WorkPhone',
		'WorkPhone2',
		'Fax',
		'Website',
		'Description',
		array('name'=>'Active', 'value'=>$model->Active == 1 ? 'Yes' : 'No'),
		'DateAdded',
		
	);
    
    $user = $model->user;
    $profileFields=ProfileField::model()->forAll()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
                       $attribute_value = $user->profile->getAttribute($field->varname);
                       $widgetView = $field->widgetView($user->profile);
                       if($field->varname == 'profilePhoto'){
                           $widgetView = '<img src="'.Yii::app()->baseUrl.'/'.$attribute_value.'"  style="width:100px;height:100ox"/>';
                       
			array_push($attributes,array(
					'label' => UserModule::t($field->title),
					'name' => $field->varname,
					'type'=>'raw',
					'value' => (($field->widgetView($user->profile))
                                                        ?$widgetView
                                                        :(($field->range)?Profile::range($field->range,$attribute_value):$attribute_value)),
				));
                      }
		} 
	}
    
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'attributes'=>$attributes,
)); ?>
