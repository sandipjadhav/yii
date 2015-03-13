<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('index'),
	$model->username,
);
?>
<h1><?php echo UserModule::t('View User').' "'.$model->username.'"'; ?></h1>

<ul class="actions">
	<li><?php echo CHtml::link(UserModule::t('List User'),array('index')); ?></li>
</ul><!-- actions -->

<?php 

// For all users
	$attributes = array(
			'username',
	);
if ($model->profile) {
    $profileFields = ProfileField::model()->forAll()->sort()->findAll();
    if ($profileFields) {
        foreach ($profileFields as $field) {
            $attribute_value = $model->profile->getAttribute($field->varname);
            $widgetView = $field->widgetView($model->profile);
            if ($field->varname == 'profilePhoto') {
                $widgetView = '<img src="' . Yii::app()->baseUrl . '/' . $attribute_value . '"  style="width:100px;height:100ox"/>';
            }
            array_push($attributes, array(
                'label' => UserModule::t($field->title),
                'name' => $field->varname,
                'type' => 'raw',
                'value' => (($field->widgetView($model->profile))
                    ? $widgetView
                    : (($field->range) ? Profile::range($field->range, $attribute_value) : $attribute_value)),
            ));
        }
    }
}
	array_push($attributes,
		array(
			'name' => 'createtime',
			'value' => date("d.m.Y H:i:s",$model->createtime),
		),
		array(
			'name' => 'lastvisit',
			'value' => (($model->lastvisit)?date("d.m.Y H:i:s",$model->lastvisit):UserModule::t('Not visited')),
		)
	);
			
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));

?>
