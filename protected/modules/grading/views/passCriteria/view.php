<?php
/* @var $this PassCriteriaController */
/* @var $model PassCriteria */

$this->breadcrumbs=array(
	'Pass Criterias'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List PassCriteria', 'url'=>array('index')),
	array('label'=>'Create PassCriteria', 'url'=>array('create')),
	array('label'=>'Update PassCriteria', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete PassCriteria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage PassCriteria', 'url'=>array('admin')),
);
?>

<h1>View PassCriteria #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'unit_id',
		'criteria_no',
		'criteria_title',
	),
)); ?>
