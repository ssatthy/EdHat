<?php
/* @var $this LearningOCController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Learning Ocs',
);

$this->menu=array(
	array('label'=>'Create LearningOC', 'url'=>array('create')),
	array('label'=>'Manage LearningOC', 'url'=>array('admin')),
);
?>

<h1>Learning Ocs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
