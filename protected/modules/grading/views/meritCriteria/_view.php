<?php
/* @var $this MeritCriteriaController */
/* @var $data MeritCriteria */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unit_id')); ?>:</b>
	<?php echo CHtml::encode($data->unit_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('criteria_no')); ?>:</b>
	<?php echo CHtml::encode($data->criteria_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('criteria_title')); ?>:</b>
	<?php echo CHtml::encode($data->criteria_title); ?>
	<br />


</div>