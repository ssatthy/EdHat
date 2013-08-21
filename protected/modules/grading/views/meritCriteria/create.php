<?php
/* @var $this MeritCriteriaController */
/* @var $model MeritCriteria */

$this->breadcrumbs=array(
	'Merit Criterias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MeritCriteria', 'url'=>array('index')),
	array('label'=>'Manage MeritCriteria', 'url'=>array('admin')),
);
?>

<h1>Create MeritCriteria</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>