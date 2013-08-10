<?php
/* @var $this CourseController */
/* @var $model Course */

$this->breadcrumbs=array(
	'Courses'=>array('index'),
	$model->CourseIndex,
);

$this->menu=array(
	array('label'=>'List Course', 'url'=>array('index')),
	array('label'=>'Create Course', 'url'=>array('create')),
	array('label'=>'Update Course', 'url'=>array('update', 'id'=>$model->CourseIndex)),
	array('label'=>'Delete Course', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->CourseIndex),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Course', 'url'=>array('admin')),
);
?>

<h1>View Course #<?php echo $model->CourseIndex; ?></h1>

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
