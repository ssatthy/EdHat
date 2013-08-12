<?php
/* @var $this CenterController */
/* @var $model Center */

$this->breadcrumbs=array(
	'Centers'=>array('index'),
	$model->centerid,
);

$this->menu=array(
	array('label'=>'All Centers', 'url'=>array('index')),
	
);
?>

<h1><?php echo $model->cent_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'centerid',
		'cent_name',
		'status',
		//'country_id',
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
		//'Catagory',
		//'Level',
		//'SemiCount',
		/*
		'CertificateFee',
		'CourseType',
		'EnterdBy',
		*/
		
	),
     'template'=>'{items}',
    'htmlOptions'=>array('style'=>'cursor: pointer;'),
'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('grading/course/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
)); ?>
