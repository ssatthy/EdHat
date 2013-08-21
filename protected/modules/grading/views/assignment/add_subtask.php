<?php
/* @var $this AssignmentController */
/* @var $model Assignment */

$this->breadcrumbs=array(
	'Assignments'=>array('index'),
	$model->title,
);

$this->menu=array(
	/*
	array('label'=>'Update Assignment', 'url'=>array('update', 'id'=>$model->mngid)),
	array('label'=>'Delete Assignment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mngid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Add PassCriteria', 'url'=>array('admin')),
        array('label'=>'Add Tasks', 'url'=>array('admin')),
    */
);
?>

<h1>Assignment Details</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'mngid',
		//'unitid',
		'assign_no',
		'title',
		'status',
	),
)); ?>

<br>
<br>
<h1>Add Subtasks</h1>

<?php echo $this->renderPartial('_subtaskForm', array('model'=>$subtask)); ?>