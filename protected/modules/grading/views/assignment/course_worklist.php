<?php

$this->menu=array(
	array('label'=>'Approve All', 'url'=>array('','')),

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
<h3> Course work list</h3>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'course-grid',
	'dataProvider'=>$courseworks,
	'columns'=>array(
		'student_id',
	),
     'template'=>'{items}',
    'htmlOptions'=>array('style'=>'cursor: pointer;'),
'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('grading/assignment/CourseWorkView', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
)); ?>
