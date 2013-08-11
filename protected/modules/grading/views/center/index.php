<?php
/* @var $this CenterController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Centers',
);

$this->menu=array(
	array('label'=>'Grid View', 'url'=>array('admin')),
);
?>

<h1>Centers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
