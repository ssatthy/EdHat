<?php
/* @var $this AssignmentController */
/* @var $model Assignment */

$this->breadcrumbs=array(
	'Assignments'=>array('index'),
	$model->title,
);

$this->menu=array(
	
	array('label'=>'Submit Assignment', 'url'=>array('coursework/create', 'id'=>$model->mngid)),
	
    
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
<h3>Submitted CourseWork </h3>

<?php 
if(count($coursework)==0)
    echo 'No course work submitted';
else
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$coursework,
	'attributes'=>array(
		array(               // related city displayed as a link
            'label'=>'File',
            'type'=>'raw',
            'value'=>CHtml::link(CHtml::encode('Download'), array('coursework/DownloadFile','id'=>$coursework->id)),
        ),
	),
)); ?>
