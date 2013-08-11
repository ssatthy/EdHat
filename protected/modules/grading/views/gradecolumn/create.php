<?php
/* @var $this GradecolumnController */
/* @var $model Gradecolumn */

$this->breadcrumbs=array(
	'Gradecolumns'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Gradecolumn', 'url'=>array('index')),
	array('label'=>'Manage Gradecolumn', 'url'=>array('admin')),
);
?>

<h1>Create Gradecolumn</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>