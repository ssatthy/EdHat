<?php
/* @var $this GradeController */
/* @var $model Grade */

$this->breadcrumbs=array(
	'Grades'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Grade', 'url'=>array('index')),
	array('label'=>'Create Grade', 'url'=>array('create')),
	array('label'=>'Update Grade', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Grade', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Grade', 'url'=>array('admin')),
);
?>

<h1>View Grade #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'assign_id',
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
		'id',
		'grade_id',
		'field',
		'marks',
		'description',
	),
)); ?>
