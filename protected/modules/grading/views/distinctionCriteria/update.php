<?php
/* @var $this DistinctionCriteriaController */
/* @var $model DistinctionCriteria */

$this->breadcrumbs=array(
	'Distinction Criterias'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DistinctionCriteria', 'url'=>array('index')),
	array('label'=>'Create DistinctionCriteria', 'url'=>array('create')),
	array('label'=>'View DistinctionCriteria', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DistinctionCriteria', 'url'=>array('admin')),
);
?>

<h1>Update DistinctionCriteria <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>