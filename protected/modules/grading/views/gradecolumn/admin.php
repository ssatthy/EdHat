<?php
/* @var $this GradecolumnController */
/* @var $model Gradecolumn */

$this->breadcrumbs=array(
	'Gradecolumns'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Gradecolumn', 'url'=>array('index')),
	array('label'=>'Create Gradecolumn', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#gradecolumn-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Gradecolumns</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gradecolumn-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
	//	'grade_id',
		'field',
		'marks',
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
     'template'=>'{items}',
)); ?>
