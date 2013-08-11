<?php
/* @var $this CourseController */
/* @var $model Course */

$this->breadcrumbs=array(
	'Courses'=>array('index'),
	$model->CourseIndex,
);

$this->menu=array(
	array('label'=>'Course list view', 'url'=>array('index')),
);
?>

<h1><?php echo $model->CourseName; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'CourseIndex',
		'CourseName',
		'FacultyName',
		'Catagory',
		'Level',
		'SemiCount',
		'CertificateFee',
		'CourseType',
		'EnterdBy',
	),
)); ?>
<br>
<br>
<br>
<h1>Module List</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'module-grid',
	'dataProvider'=>$modules,
	'columns'=>array(
		//'SerialOrder',
		'ModuleIndex',
		'ModuleName',
		//'CourseNo',
		'Semister',
		'Catagery',
		/*
		'Cradit',
		'Assement',
		*/
		
	),
        'htmlOptions'=>array('style'=>'cursor: pointer;'),
'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('grading/module/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",

)); ?>
