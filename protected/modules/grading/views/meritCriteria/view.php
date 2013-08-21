<?php
/* @var $this MeritCriteriaController */
/* @var $model MeritCriteria */

$this->breadcrumbs=array(
	'Merit Criterias'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List MeritCriteria', 'url'=>array('index')),
	array('label'=>'Create MeritCriteria', 'url'=>array('create')),
	array('label'=>'Update MeritCriteria', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MeritCriteria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MeritCriteria', 'url'=>array('admin')),
);
?>

<h1>View MeritCriteria #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'unit_id',
		'criteria_no',
		'criteria_title',
	),
)); ?>
