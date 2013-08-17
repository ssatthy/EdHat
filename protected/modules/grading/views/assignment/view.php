<?php
/* @var $this AssignmentController */
/* @var $model Assignment */

$this->breadcrumbs=array(
	'Assignments'=>array('index'),
	$model->id,
);
if(!Yii::app()->user->checkAccess('0')){
$this->menu=array(
	array('label'=>'Create Grade', 'url'=>array('grade/create','id'=>$model->id)),
);
}
?>

<h1><?php echo $model->assign_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'id',
		'assign_no',
		'assign_name',
		//'serial_order',
		// 'source_file_path',
            
            array(               // related city displayed as a link
            'label'=>'File',
            'type'=>'raw',
            'value'=>CHtml::link(CHtml::encode('Download'), array('assignment/DownloadFile','id'=>$model->id)),
        ),
		'description',
	),
)); ?>
<br>
<br>

<h1>Evaluations</h1>
<?php

if(count($gradecolumns)==0)
    echo 'Not evaluated yet';
for($i=0;$i<count($gradecolumns);$i++){
    
    echo '<b>Evaluated By: '.$gradesby[$i]->verifier_id.'</b>';
 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gradecolumn-grid',
	'dataProvider'=>$gradecolumns[$i],
	'columns'=>array(
		//'id',
		//'grade_id',
		'field',
		'marks',
		'description',
                
	),
      'template'=>'{items}',
));

}
?>