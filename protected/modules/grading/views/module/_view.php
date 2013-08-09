<?php
/* @var $this ModuleController */
/* @var $data Module */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('SerialOrder')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->SerialOrder), array('view', 'id'=>$data->SerialOrder)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ModuleIndex')); ?>:</b>
	<?php echo CHtml::encode($data->ModuleIndex); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ModuleName')); ?>:</b>
	<?php echo CHtml::encode($data->ModuleName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CourseNo')); ?>:</b>
	<?php echo CHtml::encode($data->CourseNo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Semister')); ?>:</b>
	<?php echo CHtml::encode($data->Semister); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Catagery')); ?>:</b>
	<?php echo CHtml::encode($data->Catagery); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Cradit')); ?>:</b>
	<?php echo CHtml::encode($data->Cradit); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('Assement')); ?>:</b>
	<?php echo CHtml::encode($data->Assement); ?>
	<br />

	*/ ?>

</div>