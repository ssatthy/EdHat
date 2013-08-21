<?php
/* @var $this PassCriteriaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Pass Criterias',
);

$this->menu=array(
	array('label'=>'Create PassCriteria', 'url'=>array('create')),
	array('label'=>'Manage PassCriteria', 'url'=>array('admin')),
);
?>

<h1>Pass Criterias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
