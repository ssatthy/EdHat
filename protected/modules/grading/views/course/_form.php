<?php
/* @var $this CourseController */
/* @var $model Course */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'course-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'CourseIndex'); ?>
		<?php echo $form->textField($model,'CourseIndex',array('size'=>60,'maxlength'=>253)); ?>
		<?php echo $form->error($model,'CourseIndex'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CourseName'); ?>
		<?php echo $form->textArea($model,'CourseName',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'CourseName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FacultyName'); ?>
		<?php echo $form->textField($model,'FacultyName',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'FacultyName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Catagory'); ?>
		<?php echo $form->textField($model,'Catagory',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'Catagory'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Level'); ?>
		<?php echo $form->textField($model,'Level',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'Level'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SemiCount'); ?>
		<?php echo $form->textField($model,'SemiCount'); ?>
		<?php echo $form->error($model,'SemiCount'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CertificateFee'); ?>
		<?php echo $form->textField($model,'CertificateFee'); ?>
		<?php echo $form->error($model,'CertificateFee'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CourseType'); ?>
		<?php echo $form->textField($model,'CourseType',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'CourseType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EnterdBy'); ?>
		<?php echo $form->textField($model,'EnterdBy',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'EnterdBy'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->