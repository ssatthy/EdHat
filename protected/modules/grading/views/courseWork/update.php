<?php
/* @var $this CourseWorkController */
/* @var $model CourseWork */

$this->breadcrumbs=array(
	'Course Works'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List CourseWork', 'url'=>array('index')),
	array('label'=>'Create CourseWork', 'url'=>array('create')),
	array('label'=>'View CourseWork', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage CourseWork', 'url'=>array('admin')),
);
?>

<h1>Update CourseWork <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>