<?php
/* @var $this LearningOCController */
/* @var $model LearningOC */

$this->breadcrumbs=array(
	'Learning Ocs'=>array('index'),
	$model->title=>array('view','id'=>$model->lerocid),
	'Update',
);

$this->menu=array(
	array('label'=>'List LearningOC', 'url'=>array('index')),
	array('label'=>'Create LearningOC', 'url'=>array('create')),
	array('label'=>'View LearningOC', 'url'=>array('view', 'id'=>$model->lerocid)),
	array('label'=>'Manage LearningOC', 'url'=>array('admin')),
);
?>

<h1>Update LearningOC <?php echo $model->lerocid; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>