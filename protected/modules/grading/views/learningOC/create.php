<?php
/* @var $this LearningOCController */
/* @var $model LearningOC */

$this->breadcrumbs=array(
	'Learning Ocs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List LearningOC', 'url'=>array('index')),
	array('label'=>'Manage LearningOC', 'url'=>array('admin')),
);
?>

<h1>Create LearningOC</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>