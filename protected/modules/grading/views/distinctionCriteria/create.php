<?php
/* @var $this DistinctionCriteriaController */
/* @var $model DistinctionCriteria */

$this->breadcrumbs=array(
	'Distinction Criterias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DistinctionCriteria', 'url'=>array('index')),
	array('label'=>'Manage DistinctionCriteria', 'url'=>array('admin')),
);
?>

<h1>Create DistinctionCriteria</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>