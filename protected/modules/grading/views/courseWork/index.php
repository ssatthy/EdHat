<?php
/* @var $this CourseWorkController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Course Works',
);

$this->menu=array(
	array('label'=>'Create CourseWork', 'url'=>array('create')),
	array('label'=>'Manage CourseWork', 'url'=>array('admin')),
);
?>

<h1>Course Works</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
