<?php
/* @var $this CenterController */
/* @var $data Center */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('centerid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->centerid), array('view', 'id'=>$data->centerid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cent_name')); ?>:</b>
	<?php echo CHtml::encode($data->cent_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_id')); ?>:</b>
	<?php echo CHtml::encode($data->country_id); ?>
	<br />


</div>