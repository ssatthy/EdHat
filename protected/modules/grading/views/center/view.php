<?php
/* @var $this CenterController */
/* @var $model Center */

$this->breadcrumbs=array(
	'Centers'=>array('index'),
	$model->centerid,
);

$this->menu=array(
	array('label'=>'List Center', 'url'=>array('index')),
	array('label'=>'Create Center', 'url'=>array('create')),
	array('label'=>'Update Center', 'url'=>array('update', 'id'=>$model->centerid)),
	array('label'=>'Delete Center', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->centerid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Center', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->cent_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'centerid',
		'cent_name',
		'status',
		'country_id',
	),
)); ?>
<br>
<br>
<br>

<h1> Course List </h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'course-grid',
	'dataProvider'=>$courses,
	'columns'=>array(
		'CourseIndex',
		'CourseName',
		'FacultyName',
		'Catagory',
		'Level',
		'SemiCount',
		/*
		'CertificateFee',
		'CourseType',
		'EnterdBy',
		*/
		
	),
    'htmlOptions'=>array('style'=>'cursor: pointer;'),
'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('grading/course/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
)); ?>
