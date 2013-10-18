<?php
/* @var $this AssignmentController */
/* @var $model Assignment */

$this->breadcrumbs=array(
	'Assignments'=>array('index'),
	$model->title,
);



?>

<h1>Assignment Details</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'mngid',
		//'unitid',
		'assign_no',
		'title',
		'status',
	),
)); ?>


<br>
<br>
<h3>Create Grade</h3>
<?php echo $this->renderPartial('/grade/grade_meritcriteria_form', array('criteria'=>$criteria,'criteriaitems'=>$criteriaitem,'meritgrade'=>$meritgrade)); ?>

