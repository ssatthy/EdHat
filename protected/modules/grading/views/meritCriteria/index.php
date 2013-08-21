<?php
/* @var $this MeritCriteriaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Merit Criterias',
);

$this->menu=array(
	array('label'=>'Create MeritCriteria', 'url'=>array('create')),
	array('label'=>'Manage MeritCriteria', 'url'=>array('admin')),
);
?>

<h1>Merit Criterias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
