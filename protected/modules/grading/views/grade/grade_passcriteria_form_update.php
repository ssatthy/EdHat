<div >
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'my-form',
    'enableClientValidation' => true,
        'clientOptions'=> array('validateOnSubmit'=>true,
                                 'afterValidate'=>'js:function() 
                                        {     
                                           return true;
                                        }'
                                ),
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); 
?>
   
<table class="appendo-gii">
<tr><th>Criteria</th><th>Evidence</th><th>Page No</th><th>Satisfaction</th><th>Feedback</th></tr>
</table>
<?php 
$i=0;
for($x=0;$x<sizeof($criteria);$x++){ ?>

<h5> <?php echo $criteria[$x]->criteria_no.' '.$criteria[$x]->criteria_title; ?></h5>

<?php foreach($criteriaitems[$x]->getData() as $record){?>
<table class="appendo-gii">
<tr>
 <td><?php echo CHtml::activeLabel($record,$record->item_no) ?></td>
 <td><?php echo CHtml::activeLabel($record,$record->title) ?></td>
  <td><?php echo CHtml::activeHiddenField($passgrade,"[$i]id",array('value'=>$dataitems[$i]->id)) ?></td>
 <td><?php echo CHtml::activeHiddenField($passgrade,"[$i]criteria_id",array('value'=>$dataitems[$i]->criteria_id)) ?></td>
 <td><?php echo CHtml::activeHiddenField($passgrade,"[$i]verifier_id",array('value'=>Yii::app()->user->id)) ?></td>
 <td><?php echo CHtml::activeHiddenField($passgrade,"[$i]verifier_type",array('value'=>Yii::app()->user->role)) ?></td>
 
 
<td><?php echo CHtml::activeTextField($passgrade,"[$i]page_no",array('value'=>$dataitems[$i]->page_no)) ?>
 <?php echo $form->error($passgrade,"[$i]page_no"); ?></td>

<td><?php  echo $form->dropDownList($passgrade,"[$i]grade",array('' => 'Select one','OK'=>'Satisfied','NOK'=>'NotSatisfied'),array('options' => array($dataitems[$i]->grade=>array('selected'=>true)))); ?>
 <?php echo $form->error($passgrade,"[$i]grade"); ?>

 </td>
<td><?php echo CHtml::activeTextArea($passgrade,"[$i]feedback",array('value'=>$dataitems[$i]->feedback)) ?>
 <?php echo $form->error($passgrade,"[$i]feedback"); ?></td>
</tr>
</table>
<?php $i++; } } ?>

 
 <div class="row buttons">
                <?php echo CHtml::submitButton( 'Save'); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->