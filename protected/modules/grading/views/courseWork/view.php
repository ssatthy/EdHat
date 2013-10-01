<?php
/* @var $this CourseWorkController */
/* @var $model CourseWork */

$this->breadcrumbs=array(
	'Course Works'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List CourseWork', 'url'=>array('index')),
	array('label'=>'Create CourseWork', 'url'=>array('create')),
	array('label'=>'Update CourseWork', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete CourseWork', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage CourseWork', 'url'=>array('admin')),
);
?>

<h1>View CourseWork #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'assign_id',
		'student_id',
		'source_file_path',
	),
)); ?>
