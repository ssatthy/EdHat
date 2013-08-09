<?php
/* @var $this ModuleController */
/* @var $model Module */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'module-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ModuleIndex'); ?>
		<?php echo $form->textField($model,'ModuleIndex',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'ModuleIndex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ModuleName'); ?>
		<?php echo $form->textArea($model,'ModuleName',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'ModuleName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CourseNo'); ?>
		<?php echo $form->textField($model,'CourseNo',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'CourseNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Semister'); ?>
		<?php echo $form->textField($model,'Semister'); ?>
		<?php echo $form->error($model,'Semister'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Catagery'); ?>
		<?php echo $form->textField($model,'Catagery',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'Catagery'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Cradit'); ?>
		<?php echo $form->textField($model,'Cradit'); ?>
		<?php echo $form->error($model,'Cradit'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Assement'); ?>
		<?php echo $form->textField($model,'Assement',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Assement'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->