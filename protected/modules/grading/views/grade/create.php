<?php
/* @var $this GradeController */
/* @var $model Grade */

$this->breadcrumbs=array(
	'Grades'=>array('index'),
	'Create',
);

$this->menu=array(
	
);
?>

<h1>Create Grade</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'columns'=>$columns)); ?>

