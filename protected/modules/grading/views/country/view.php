<?php
/* @var $this CountryController */
/* @var $model Country */

$this->breadcrumbs=array(
	'Countries'=>array('index'),
	$model->country_id,
);

$this->menu=array(
	array('label'=>'Country list View', 'url'=>array('index')),
	array('label'=>'Country grid View', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->country_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'country_id',
		'country_name',
		'status',
	),
)); ?>
<br>
<br>
<br>
<h1>Center List</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'center-grid',
	'dataProvider'=>$centers,
	'columns'=>array(
		//'centerid',
		'cent_name',
		'status',
		//'country_id',
		
	),
     'template'=>'{items}',
    'htmlOptions'=>array('style'=>'cursor: pointer;'),
'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('grading/center/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",
)); ?>

