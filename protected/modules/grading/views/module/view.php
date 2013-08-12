<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
	'Modules'=>array('index'),
	$model->SerialOrder,
);

$this->menu=array(
	array('label'=>'Module list view', 'url'=>array('index')),
);
?>

<h1><?php echo $model->ModuleName; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'SerialOrder',
		'ModuleIndex',
		'ModuleName',
		'CourseNo',
		'Semister',
		'Catagery',
		//'Cradit',
		//'Assement',
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
		//'id',
		'assign_no',
		'assign_name',
		//'serial_order',
		//'source_file_path',
		'description',
		
	),
     'template'=>'{items}',
     'htmlOptions'=>array('style'=>'cursor: pointer;'),
'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('grading/assignment/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",

)); ?>
