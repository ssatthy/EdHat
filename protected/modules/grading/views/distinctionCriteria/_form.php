<?php
/* @var $this DistinctionCriteriaController */
/* @var $model DistinctionCriteria */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'distinction-criteria-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'unit_id'); ?>
		<?php echo $form->textField($model,'unit_id'); ?>
		<?php echo $form->error($model,'unit_id'); ?>
	</div>
*/?>
	<div class="row">
		<?php echo $form->labelEx($model,'criteria_no'); ?>
		<?php echo $form->textField($model,'criteria_no',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'criteria_no'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'criteria_title'); ?>
		<?php echo $form->textArea($model,'criteria_title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'criteria_title'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->