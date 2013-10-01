<?php
/* @var $this AssignmentController */
/* @var $model Assignment */

$this->breadcrumbs=array(
	'Assignments'=>array('index'),
	
);

$this->menu=array(
	/*
	array('label'=>'Update Assignment', 'url'=>array('update', 'id'=>$model->mngid)),
	array('label'=>'Delete Assignment', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->mngid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Add PassCriteria', 'url'=>array('admin')),
        array('label'=>'Add Tasks', 'url'=>array('admin')),
    */
);
?>

<h1>Add Distinction Criteria </h1>

<?php echo $this->renderPartial('_distinctionItemForm', array('model'=>$criteriaitems)); ?>