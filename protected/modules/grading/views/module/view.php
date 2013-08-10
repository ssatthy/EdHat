<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
	'Modules'=>array('index'),
	$model->SerialOrder,
);

$this->menu=array(
	array('label'=>'List Module', 'url'=>array('index')),
	array('label'=>'Create Module', 'url'=>array('create')),
	array('label'=>'Update Module', 'url'=>array('update', 'id'=>$model->SerialOrder)),
	array('label'=>'Delete Module', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->SerialOrder),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Module', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->ModuleName; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'SerialOrder',
		'ModuleIndex',
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
		//'id',
		'assign_no',
		'assign_name',
		//'serial_order',
		'source_file_path',
		'description',
		
	),
     'htmlOptions'=>array('style'=>'cursor: pointer;'),
'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('grading/assignment/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",

)); ?>
