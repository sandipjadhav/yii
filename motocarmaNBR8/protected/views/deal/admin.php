<?php
/* @var $this DealController */
/* @var $model Deal */

$this->breadcrumbs=array(
	'Deals'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Deal', 'url'=>array('index')),
	array('label'=>'Create Deal', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#deal-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Deals</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'deal-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		array('name' => 'car.Make'),
                array('name'=>'dealership.Name'),
		array('name' => 'dealStatus.DealStatus'),
		'SalesPerson_ID',
		array(
                    'name' => 'User',
                'header'=>'username',
                'value'=>$model->getRelated('user')->username, //column name, php expression
                'type'=>'raw',
            ),
		'Price',
		/*
		'DateAdded',
		'LastModified',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
