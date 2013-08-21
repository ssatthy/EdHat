<?php
/* @var $this AssignmentController */
/* @var $model Assignment */

$this->breadcrumbs=array(
	'Assignments'=>array('index'),
	$model->title,
);

$this->menu=array(
	
	array('label'=>'Update Assignment', 'url'=>array('update', 'id'=>$model->mngid)),
	array('label'=>'Delete Assignment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mngid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Add PassCriteria', 'url'=>array('addpasscriteriaitem','id'=>$model->mngid)),
        array('label'=>'Add Tasks', 'url'=>array('addtask','id'=>$model->mngid)),
        array('label'=>'Add Subtasks', 'url'=>array('addsubtask','id'=>$model->mngid)),
    
);
?>

<h1>Assignment Details</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'mngid',
		//'unitid',
		'assign_no',
		'title',
		'status',
	),
)); ?>

<br>
<br>
<h1>Pass Criteria</h1>
<?php

if(count($pass_criteria)==0)
    echo 'No criteria has been set';
for($i=0;$i<count($pass_criteria);$i++){
    
    echo '<b>Criteria No: '.$pass_criteria[$i]->criteria_no.'</b>';
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gradecolumn-grid',
	'dataProvider'=>$pass_cri_items[$i],
	'columns'=>array(
		
		'item_no',
		'title',
		
                
	),
      'template'=>'{items}',
));

}
?>

<br>
<br>
<h1>Tasks</h1>
<?php

if(count($tasks)==0)
    echo 'No task has been set';

for($i=0;$i<count($tasks);$i++){
    
    echo '<b>Task No: '.$tasks[$i]->task_no.'</b>';
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gradecolumn-grid',
	'dataProvider'=>$subtasks[$i],
	'columns'=>array(
		
		'sub_no',
		'title',
                'max_marks'
		
                
	),
      'template'=>'{items}',
));

}
?>
