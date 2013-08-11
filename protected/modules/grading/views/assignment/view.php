<?php
/* @var $this AssignmentController */
/* @var $model Assignment */

$this->breadcrumbs=array(
	'Assignments'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Create Grade', 'url'=>array('grade/create')),
);
?>

<h1><?php echo $model->assign_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'assign_no',
		'assign_name',
		//'serial_order',
		'source_file_path',
		'description',
	),
)); ?>
