<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
	'Modules'=>array('index'),
	$model->SerialOrder,
);

$this->menu=array(
	array('label'=>'Create assignment', 'url'=>array('assignment/create')),
    array('label'=>' LearningOC', 'url'=>array('learningoc/admin')),
    array('label'=>' PassCriteria', 'url'=>array('passcriteria/admin')),
    array('label'=>' MeritCriteria', 'url'=>array('meritcriteria/admin')),
    array('label'=>' DistinctionCriteria', 'url'=>array('distinctioncriteria/admin')),
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
		'title',
		
		//'source_file_path',
		'status',
		
	),
     'template'=>'{items}',
     'htmlOptions'=>array('style'=>'cursor: pointer;'),
'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('grading/assignment/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",

)); ?>
