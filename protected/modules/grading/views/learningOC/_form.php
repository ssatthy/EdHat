<?php
/* @var $this LearningOCController */
/* @var $model LearningOC */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'learning-oc-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'unitid'); ?>
		<?php echo $form->textField($model,'unitid'); ?>
		<?php echo $form->error($model,'unitid'); ?>
	</div>
*/?>
	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>660)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'discription'); ?>
		<?php echo $form->textArea($model,'discription',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'discription'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qpersentage'); ?>
		<?php echo $form->textField($model,'qpersentage'); ?>
		<?php echo $form->error($model,'qpersentage'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->