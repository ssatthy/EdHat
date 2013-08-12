<?php
/* @var $this GradecolumnController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Gradecolumns',
);

$this->menu=array(
	array('label'=>'Create Gradecolumn', 'url'=>array('create')),
);
?>

<h1>Gradecolumns</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
