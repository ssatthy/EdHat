<?php
/* @var $this CourseWorkController */
/* @var $data CourseWork */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assign_id')); ?>:</b>
	<?php echo CHtml::encode($data->assign_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('student_id')); ?>:</b>
	<?php echo CHtml::encode($data->student_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('source_file_path')); ?>:</b>
	<?php echo CHtml::encode($data->source_file_path); ?>
	<br />


</div>