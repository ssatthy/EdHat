<?php
/* @var $this DistinctionCriteriaController */
/* @var $model DistinctionCriteria */

$this->breadcrumbs=array(
	'Distinction Criterias'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DistinctionCriteria', 'url'=>array('index')),
	array('label'=>'Create DistinctionCriteria', 'url'=>array('create')),
	array('label'=>'Update DistinctionCriteria', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DistinctionCriteria', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DistinctionCriteria', 'url'=>array('admin')),
);
?>

<h1>Distinction Criteria Details</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'unit_id',
		'criteria_no',
		'criteria_title',
	),
)); ?>

<br>

<?php

if(count($distn_cri_items)==0)
    echo 'No criteria has been set';
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gradecolumn-grid',
	'dataProvider'=>$distn_cri_items,
	'columns'=>array(
		
		'item_no',
		'title',
		
                
	),
      'template'=>'{items}',
));

?>
