<?php
/* @var $this GradecolumnController */
/* @var $model Gradecolumn */

$this->breadcrumbs=array(
	'Gradecolumns'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Gradecolumn', 'url'=>array('index')),
	array('label'=>'Create Gradecolumn', 'url'=>array('create')),
	array('label'=>'Update Gradecolumn', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Gradecolumn', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Gradecolumn', 'url'=>array('admin')),
);
?>

<h1>View Gradecolumn #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'grade_id',
		'field',
		'marks',
		'description',
	),
)); ?>
