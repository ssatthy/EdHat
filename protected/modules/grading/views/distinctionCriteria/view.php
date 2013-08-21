<?php
/* @var $this DistinctionCriteriaController */
/* @var $model DistinctionCriteria */

$this->breadcrumbs=array(
	'Distinction Criterias'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DistinctionCriteria', 'url'=>array('index')),
	array('label'=>'Create DistinctionCriteria', 'url'=>array('create')),
	array('label'=>'Update DistinctionCriteria', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DistinctionCriteria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DistinctionCriteria', 'url'=>array('admin')),
);
?>

<h1>View DistinctionCriteria #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'unit_id',
		'criteria_no',
		'criteria_title',
	),
)); ?>
