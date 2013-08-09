<?php
/* @var $this CenterController */
/* @var $model Center */

$this->breadcrumbs=array(
	'Centers'=>array('index'),
	$model->centerid,
);

$this->menu=array(
	array('label'=>'List Center', 'url'=>array('index')),
	array('label'=>'Create Center', 'url'=>array('create')),
	array('label'=>'Update Center', 'url'=>array('update', 'id'=>$model->centerid)),
	array('label'=>'Delete Center', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->centerid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Center', 'url'=>array('admin')),
);
?>

<h1>View Center #<?php echo $model->centerid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'centerid',
		'cent_name',
		'status',
		'country_id',
	),
)); ?>
