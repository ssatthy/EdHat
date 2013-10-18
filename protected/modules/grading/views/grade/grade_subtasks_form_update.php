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
<tr><th>Task No</th><th>Title</th><th>Covert Criteria</th><th>Max Marks</th><th>Given Marks</th></tr>
</table>
<?php 
$i=0;
for($x=0;$x<sizeof($tasks);$x++){ ?>

<h5> <?php echo $tasks[$x]->task_no.'    '.$tasks[$x]->lo->title; ?></h5>

<?php foreach($subtasks[$x]->getData() as $record){?>
<table class="appendo-gii">
<tr>
 <td><?php echo CHtml::activeLabel($record,$record->sub_no) ?></td>
 <td><?php echo CHtml::activeLabel($record,$record->title) ?></td>
   <td><?php echo CHtml::activeHiddenField($taskgrade,"[$i]id",array('value'=>$dataitems[$i]->id)) ?></td>
 <td><?php echo CHtml::activeHiddenField($taskgrade,"[$i]subtask_id",array('value'=>$record->id)) ?></td>
 <td><?php echo CHtml::activeHiddenField($taskgrade,"[$i]verifier_id",array('value'=>Yii::app()->user->id)) ?></td>
 <td><?php echo CHtml::activeHiddenField($taskgrade,"[$i]verifier_type",array('value'=>Yii::app()->user->role)) ?></td>
 
 <td><?php echo CHtml::activeLabel($record,$record->passCritItem->item_no) ?></td>
<td><?php echo CHtml::activeLabel($record,$record->max_marks) ?></td>

<td><?php echo CHtml::activeTextField($taskgrade,"[$i]marks",array('value'=>$dataitems[$i]->marks)) ?>
 <?php echo $form->error($taskgrade,"[$i]marks"); ?></td>
</tr>
</table>
<?php $i++; } } ?>

 
 <div class="row buttons">
                <?php echo CHtml::submitButton( 'Save'); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- form -->