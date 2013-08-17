<?php
/* @var $this AssignmentController */
/* @var $data Assignment */
?>

<div class="view">
    <?php
/*
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />
*/
    ?>
        <b><?php echo CHtml::encode('Course Name'); ?>:</b>
	<?php echo CHtml::encode($coursename); ?>
	<br />
        
        <b><?php echo CHtml::encode('Module Name'); ?>:</b>
	<?php echo CHtml::encode($modulename); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('assign_no')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->assign_no), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('assign_name')); ?>:</b>
        <?php echo CHtml::link(CHtml::encode($data->assign_name), array('view', 'id'=>$data->id)); ?>
	<br />
   <?php
/*
	<b><?php echo CHtml::encode($data->getAttributeLabel('serial_order')); ?>:</b>
	<?php echo CHtml::encode($data->serial_order); ?>
	<br />
*/
    ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('source_file_path')); ?>:</b>
         <?php echo CHtml::link(CHtml::encode('Download'), array('assignment/DownloadFile','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>