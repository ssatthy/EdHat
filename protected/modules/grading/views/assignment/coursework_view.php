<?php

$this->menu=array(
	array('label'=>'Grade PassCriteria', 'url'=>array('HandlePassCriteria','id'=>$coursework->id)),
	array('label'=>'Grade MeriteCriteria', 'url'=>array('HandleMeritCriteria','id'=>$coursework->id)),
        array('label'=>'Grade DistinctionCriteria', 'url'=>array('HandleDistinctionCriteria','id'=>$coursework->id)),
        array('label'=>'Grade Tasks', 'url'=>array('HandleTasks','id'=>$coursework->id)),
        array('label'=>'Approve This', 'url'=>array('CourseWork/ApproveCourseWork','id'=>$coursework->id)),
);
?>

<br>
<br>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>
<h1>Assignment Details</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$assignment,
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
<h1>Course work Details</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$coursework,
	'attributes'=>array(
		
		'student_id',
		'source_file_path',
		
	),
)); ?>
<br>
<br>
<h2>Grading Details</h2>

<table border="1">
<tr>
<th>Criteria</th>
<th>Status</th>
</tr>
<tr>
<td>Pass</td>
<td>
<?php if(Yii::app()->user->role==1)echo $courseworkstatus->prof_pass; ?>
<?php if(Yii::app()->user->role==2)echo $courseworkstatus->int_pass; ?>
<?php if(Yii::app()->user->role==3)echo $courseworkstatus->ext_pass; ?>
</td>
</tr>
<tr>
<td>Merit</td>
<td>
<?php if(Yii::app()->user->role==1)echo $courseworkstatus->prof_merit; ?>
<?php if(Yii::app()->user->role==2)echo $courseworkstatus->int_merit; ?>
<?php if(Yii::app()->user->role==3)echo $courseworkstatus->ext_merit; ?>
</td>
</tr>
<tr>
<td>Distinction</td>
<td>
<?php if(Yii::app()->user->role==1)echo $courseworkstatus->prof_distn; ?>
<?php if(Yii::app()->user->role==2)echo $courseworkstatus->int_distn; ?>
<?php if(Yii::app()->user->role==3)echo $courseworkstatus->ext_distn; ?>
</td>
</tr>
<td>Tasks</td>
<td>
<?php if(Yii::app()->user->role==1)echo $courseworkstatus->prof_task; ?>
<?php if(Yii::app()->user->role==2)echo $courseworkstatus->int_task; ?>
<?php if(Yii::app()->user->role==3)echo $courseworkstatus->ext_task; ?>
</td>
</tr>
<td>Approved</td>
<td>
<?php if(Yii::app()->user->role==1) echo $courseworkstatus->prof_approved==''? 'NO':'OK'; ?>
<?php if(Yii::app()->user->role==2)echo $courseworkstatus->int_approved==''? 'NO':'OK'; ?>
<?php if(Yii::app()->user->role==3)echo $courseworkstatus->ext_approved==''? 'NO':'OK'; ?>
</td>
</tr>
</table> 