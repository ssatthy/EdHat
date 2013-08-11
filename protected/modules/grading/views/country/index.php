<?php
/* @var $this CountryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Countries',
);

$this->menu=array(
	array('label'=>'Grid View', 'url'=>array('admin')),
);
?>

<h1>Countries</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
