<?php
/* @var $this AssignmentController */
/* @var $data Assignment */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('mngid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->mngid), array('view', 'id'=>$data->mngid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unitid')); ?>:</b>
	<?php echo CHtml::encode($data->unitid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assign_no')); ?>:</b>
	<?php echo CHtml::encode($data->assign_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>