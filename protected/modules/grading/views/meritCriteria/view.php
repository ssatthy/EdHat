<?php
/* @var $this MeritCriteriaController */
/* @var $model MeritCriteria */

$this->breadcrumbs=array(
	'Merit Criterias'=>array('index'),
	$model->id,
);

$this->menu=array(
    
     array('label'=>'Add Criteria items', 'url'=>array('addmeritcriteriaitem')),
    /*
	array('label'=>'List MeritCriteria', 'url'=>array('index')),
	array('label'=>'Create MeritCriteria', 'url'=>array('create')),
	array('label'=>'Update MeritCriteria', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MeritCriteria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MeritCriteria', 'url'=>array('admin')),
     * *
     */
);
?>

<h1>MeritCriteria Details</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		//'unit_id',
		'criteria_no',
		'criteria_title',
	),
)); ?>

<br>

<?php

if(count($merit_cri_items)==0)
    echo 'No criteria has been set';
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gradecolumn-grid',
	'dataProvider'=>$merit_cri_items,
	'columns'=>array(
		
		'item_no',
		'title',
		
                
	),
      'template'=>'{items}',
));

?>
