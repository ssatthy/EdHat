<?php
/* @var $this CourseWorkController */
/* @var $model CourseWork */

$this->breadcrumbs=array(
	'Course Works'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List CourseWork', 'url'=>array('index')),
	array('label'=>'Manage CourseWork', 'url'=>array('admin')),
);
?>

<h1>Create CourseWork</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>