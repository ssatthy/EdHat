<?php
/* @var $this GradeController */
/* @var $model Grade */

$this->breadcrumbs=array(
	'Grades'=>array('index'),
	$model->id,
);


?>

<h1>View Grade #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'assign_id',
		'student_id',
		'verifier_id',
		'comment',
	),
)); ?>

<h1>Evaluations</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gradecolumn-grid',
	'dataProvider'=>$gradings,
	'columns'=>array(
		//'id',
		//'grade_id',
		'field',
		'marks',
		'description',
	),
     'template'=>'{items}',
)); ?>
