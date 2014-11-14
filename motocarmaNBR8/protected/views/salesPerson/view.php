<?php
/* @var $this SalesPersonController */
/* @var $model SalesPerson */

$this->breadcrumbs=array(
	'Sales People'=>array('index'),
	$model->ID,
);

$this->menu=array(
	array('label'=>'List SalesPerson', 'url'=>array('index')),
	array('label'=>'Create SalesPerson', 'url'=>array('create')),
	array('label'=>'Update SalesPerson', 'url'=>array('update', 'id'=>$model->ID)),
	array('label'=>'Delete SalesPerson', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ID),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SalesPerson', 'url'=>array('admin')),
);
?>

<h1>View SalesPerson #<?php echo $model->ID; ?></h1>

<?php 
        $user = $model->user;
        $attributes = array(
		//'ID',
                array('name'=>'Dealership', 'value'=>$model->dealership->Name),
		array('name'=>'Username', 'value'=>$user->username),
                array('name'=>'First Name', 'value'=>$user->profile->getAttribute('firstname')),
                array('name'=>'Last Name', 'value'=>$user->profile->getAttribute('lastname')),
                array('name'=>'ContactPhone', 'value'=>$model->ContactPhone),
                array('name'=>'Email', 'value'=>$user->email),
		array('name'=>'Description', 'value'=>$model->Description),
		array('name'=>'DateAdded', 'value'=>$model->DateAdded),
		array('name'=>'Active', 'value'=>$model->Active == 1 ? 'Yes' : 'No'),
		);
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
		'data'=>$user,
		'attributes'=>$attributes,
	)); ?>
