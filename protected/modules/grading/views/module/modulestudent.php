<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
	'Modules'=>array('index'),
	'Manage',
);

?>


<h1>Modules List</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'module-grid',
	'dataProvider'=>$model,
	'columns'=>array(
	//	'SerialOrder',
		'ModuleIndex',
		'ModuleName',
		'CourseNo',
		'Semister',
		'Catagery',
		/*
		'Cradit',
		'Assement',
		*/
		
	),
    'template'=>'{items}',
        'htmlOptions'=>array('style'=>'cursor: pointer;'),
'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('grading/module/viewstudent', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",

)); ?>
