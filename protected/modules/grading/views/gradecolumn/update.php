<?php
/* @var $this GradecolumnController */
/* @var $model Gradecolumn */

$this->breadcrumbs=array(
	'Gradecolumns'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Gradecolumn', 'url'=>array('index')),
	array('label'=>'Create Gradecolumn', 'url'=>array('create')),
	array('label'=>'View Gradecolumn', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Gradecolumn', 'url'=>array('admin')),
);
?>

<h1>Update Gradecolumn <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>