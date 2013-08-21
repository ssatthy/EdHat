<?php
/* @var $this LearningOCController */
/* @var $data LearningOC */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('lerocid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->lerocid), array('view', 'id'=>$data->lerocid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unitid')); ?>:</b>
	<?php echo CHtml::encode($data->unitid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('discription')); ?>:</b>
	<?php echo CHtml::encode($data->discription); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('qpersentage')); ?>:</b>
	<?php echo CHtml::encode($data->qpersentage); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />


</div>