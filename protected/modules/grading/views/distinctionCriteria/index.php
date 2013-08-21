<?php
/* @var $this DistinctionCriteriaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Distinction Criterias',
);

$this->menu=array(
	array('label'=>'Create DistinctionCriteria', 'url'=>array('create')),
	array('label'=>'Manage DistinctionCriteria', 'url'=>array('admin')),
);
?>

<h1>Distinction Criterias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
