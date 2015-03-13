<?php
/* @var $this SavedCarsController */
/* @var $model SavedCars */

$this->breadcrumbs=array(
	'Saved Cars'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SavedCars', 'url'=>array('index')),
	array('label'=>'Create SavedCars', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#saved-cars-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Saved Cars</h1>

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
	'id'=>'saved-cars-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
                array('name' => 'car.Make'),
		array('name' => 'dealStatus.DealStatus'),
		array(
                    'name' => 'user.username',
                    'header'=>'username',
                    'value'=>$model->getRelated('user')->username, //column name, php expression
                    'type'=>'raw',
                ),
		'DateAdded',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
