<?php
/* @var $this CourseController */
/* @var $model Course */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'CourseIndex'); ?>
		<?php echo $form->textField($model,'CourseIndex',array('size'=>60,'maxlength'=>253)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CourseName'); ?>
		<?php echo $form->textArea($model,'CourseName',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'FacultyName'); ?>
		<?php echo $form->textField($model,'FacultyName',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Catagory'); ?>
		<?php echo $form->textField($model,'Catagory',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Level'); ?>
		<?php echo $form->textField($model,'Level',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'SemiCount'); ?>
		<?php echo $form->textField($model,'SemiCount'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CertificateFee'); ?>
		<?php echo $form->textField($model,'CertificateFee'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CourseType'); ?>
		<?php echo $form->textField($model,'CourseType',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'EnterdBy'); ?>
		<?php echo $form->textField($model,'EnterdBy',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->