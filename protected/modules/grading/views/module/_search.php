<?php
/* @var $this ModuleController */
/* @var $model Module */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'SerialOrder'); ?>
		<?php echo $form->textField($model,'SerialOrder'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ModuleIndex'); ?>
		<?php echo $form->textField($model,'ModuleIndex',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ModuleName'); ?>
		<?php echo $form->textArea($model,'ModuleName',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'CourseNo'); ?>
		<?php echo $form->textField($model,'CourseNo',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Semister'); ?>
		<?php echo $form->textField($model,'Semister'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Catagery'); ?>
		<?php echo $form->textField($model,'Catagery',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Cradit'); ?>
		<?php echo $form->textField($model,'Cradit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Assement'); ?>
		<?php echo $form->textField($model,'Assement',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->