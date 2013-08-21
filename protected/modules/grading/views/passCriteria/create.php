<?php
/* @var $this PassCriteriaController */
/* @var $model PassCriteria */

$this->breadcrumbs=array(
	'Pass Criterias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List PassCriteria', 'url'=>array('index')),
	array('label'=>'Manage PassCriteria', 'url'=>array('admin')),
);
?>

<h1>Create PassCriteria</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>