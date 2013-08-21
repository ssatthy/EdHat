<?php
/* @var $this PassCriteriaController */
/* @var $model PassCriteria */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'unit_id'); ?>
		<?php echo $form->textField($model,'unit_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'criteria_no'); ?>
		<?php echo $form->textField($model,'criteria_no',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'criteria_title'); ?>
		<?php echo $form->textArea($model,'criteria_title',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->