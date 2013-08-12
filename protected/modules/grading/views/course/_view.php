<?php
/* @var $this CourseController */
/* @var $data Course */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('CourseIndex')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->CourseIndex), array('view', 'id'=>$data->CourseIndex)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('CourseName')); ?>:</b>
	<?php echo CHtml::encode($data->CourseName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('FacultyName')); ?>:</b>
	<?php echo CHtml::encode($data->FacultyName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Catagory')); ?>:</b>
	<?php echo CHtml::encode($data->Catagory); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Level')); ?>:</b>
	<?php echo CHtml::encode($data->Level); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SemiCount')); ?>:</b>
	<?php echo CHtml::encode($data->SemiCount); ?>
	<br />
<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('CertificateFee')); ?>:</b>
	<?php echo CHtml::encode($data->CertificateFee); ?>
	<br />

	
	<b><?php echo CHtml::encode($data->getAttributeLabel('CourseType')); ?>:</b>
	<?php echo CHtml::encode($data->CourseType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('EnterdBy')); ?>:</b>
	<?php echo CHtml::encode($data->EnterdBy); ?>
	<br />

	*/ ?>

</div>