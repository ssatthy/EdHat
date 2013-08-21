<?php
/* @var $this LearningOCController */
/* @var $model LearningOC */

$this->breadcrumbs=array(
	'Learning Ocs'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List LearningOC', 'url'=>array('index')),
	array('label'=>'Create LearningOC', 'url'=>array('create')),
	array('label'=>'Update LearningOC', 'url'=>array('update', 'id'=>$model->lerocid)),
	array('label'=>'Delete LearningOC', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->lerocid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage LearningOC', 'url'=>array('admin')),
);
?>

<h1>View LearningOC #<?php echo $model->lerocid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'lerocid',
		'unitid',
		'title',
		'discription',
		'qpersentage',
		'status',
	),
)); ?>
