<?php
/* @var $this GradeController */
/* @var $model Grade */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'pass-criteria-form',
	'enableAjaxValidation'=>false,
)); ?>

           <div class="row">
            <?php $this->widget('ext.appendo.JAppendo',array(
                'id' => 'repeateEnum',        
                'items' => $model,
                'viewName' => 'task',
                'labelDel' => 'Remove Row'
                //'cssFile' => 'css/jquery.appendo2.css'
            )); ?>
            </div>
     
        <div class="row buttons">
		<?php echo CHtml::submitButton('Add'); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->