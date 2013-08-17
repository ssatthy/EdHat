<?php
/* @var $this ModuleController */
/* @var $model Module */

$this->breadcrumbs=array(
	'Modules'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Module', 'url'=>array('index')),
	
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#module-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Modules</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'module-grid',
	'dataProvider'=>$model->search(),
	
	'columns'=>array(
		//'SerialOrder',
		'ModuleIndex',
		'ModuleName',
		'CourseNo',
		//'Semister',
		'Catagery',
		/*
		'Cradit',
		'Assement',
		*/
		
	),
     'template'=>'{items}',
        'htmlOptions'=>array('style'=>'cursor: pointer;'),
'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('grading/module/view', array('id'=>'')) . "' + $.fn.yiiGridView.getSelection(id);}",

)); ?>
