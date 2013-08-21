<?php
/* @var $this MeritCriteriaController */
/* @var $model MeritCriteria */

$this->breadcrumbs=array(
	'Merit Criterias'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MeritCriteria', 'url'=>array('index')),
	array('label'=>'Create MeritCriteria', 'url'=>array('create')),
	array('label'=>'View MeritCriteria', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MeritCriteria', 'url'=>array('admin')),
);
?>

<h1>Update MeritCriteria <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>