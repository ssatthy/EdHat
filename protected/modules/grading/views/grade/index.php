<?php
/* @var $this GradeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Grades',
);

$this->menu=array(
	array('label'=>'Create Grade', 'url'=>array('create')),
);
?>

<h1>Grades</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
