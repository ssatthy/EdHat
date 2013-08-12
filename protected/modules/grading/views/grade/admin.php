<?php
/* @var $this GradeController */
/* @var $model Grade */

$this->breadcrumbs=array(
	'Grades'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Grade', 'url'=>array('index')),
	array('label'=>'Create Grade', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#grade-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Grades</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'grade-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		//'assign_id',
		'student_id',
		'verifier_id',
		'comment',
		array(
			'class'=>'CButtonColumn',
		),
	),
     'template'=>'{items}',
)); ?>
