<?php
/* @var $this GradeController */
/* @var $model Grade */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'grade-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

           <div class="row">
            <?php $this->widget('ext.appendo.JAppendo',array(
                'id' => 'repeateEnum',        
                'columns' => $columns,
                'viewName' => 'gradecolumns',
                'labelDel' => 'Remove Row'
                //'cssFile' => 'css/jquery.appendo2.css'
            )); ?>
            </div>
        
        <?php /*
	<div class="row">
		<?php echo $form->labelEx($model,'assign_id'); ?>
		<?php echo $form->textField($model,'assign_id'); ?>
		<?php echo $form->error($model,'assign_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'student_id'); ?>
		<?php echo $form->textField($model,'student_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'student_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'verifier_id'); ?>
		<?php echo $form->textField($model,'verifier_id',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'verifier_id'); ?>
	</div>
*/?>
	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

<!-- grade columns -->

 
	


        
        <div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->