<?php
$this->menu=array(
    array('label'=>'Submit Assignment', 'url'=>array('assignment/create')),
	array('label'=>'Download Assignments', 'url'=>array('assignment/index')),
);
?>
<h1><?php echo $model->ModuleName; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'SerialOrder',
		//'ModuleIndex',
		'ModuleName',
		'CourseNo',
		'Semister',
		'Catagery',
		'Cradit',
		'Assement',
	),
)); ?>
<br>
<br>
<br>

<h1>Assignment List</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'assignment-grid',
	'dataProvider'=>$assignment,
	'columns'=>array(
		'assign_no',
		'title',
		'status',
		
	),
    'template'=>'{items}',
     'htmlOptions'=>array('style'=>'cursor: pointer;'),
'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('/grading/module/AssignView', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",

)); ?>
