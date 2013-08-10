<?php
/* @var $this AssignmentController */
/* @var $model Assignment */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'assignment-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'assign_no'); ?>
		<?php echo $form->textField($model,'assign_no'); ?>
		<?php echo $form->error($model,'assign_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'assign_name'); ?>
		<?php echo $form->textField($model,'assign_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'assign_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'serial_order'); ?>
		<?php echo $form->dropDownList($model,'serial_order',$this->getModuleList()); ?>
		<?php echo $form->error($model,'serial_order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'source_file_path'); ?>
		<?php echo $form->textField($model,'source_file_path',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'source_file_path'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->