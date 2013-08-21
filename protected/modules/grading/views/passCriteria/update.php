<?php
/* @var $this PassCriteriaController */
/* @var $model PassCriteria */

$this->breadcrumbs=array(
	'Pass Criterias'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List PassCriteria', 'url'=>array('index')),
	array('label'=>'Create PassCriteria', 'url'=>array('create')),
	array('label'=>'View PassCriteria', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage PassCriteria', 'url'=>array('admin')),
);
?>

<h1>Update PassCriteria <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>