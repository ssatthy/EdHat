<?php
/* @var $this MeritCriteriaController */
/* @var $model MeritCriteria */

$this->breadcrumbs=array(
	'Merit Criterias'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List MeritCriteria', 'url'=>array('index')),
	array('label'=>'Create MeritCriteria', 'url'=>array('create')),
        array('label'=>'Add Criteria items', 'url'=>array('addmeritcriteriaitem')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#merit-criteria-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Merit Criterias</h1>

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
	'id'=>'merit-criteria-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'unit_id',
		'criteria_no',
		'criteria_title',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
