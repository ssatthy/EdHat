<div >
<?php echo CHtml::beginForm(); ?>
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
 <td><?php echo CHtml::activeTextField($grades,"[$i]grade") ?></td>
<td><?php echo CHtml::activeTextField($grades,"[$i]page_no") ?></td>
<td><?php echo CHtml::activeTextArea($grades,"[$i]feedback") ?></td>
</tr>
</table>
<?php $i++; } } ?>

 
<?php echo CHtml::submitButton('Save'); ?>
<?php echo CHtml::endForm(); ?>
</div><!-- form -->