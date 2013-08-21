<table class="appendo-gii" id="<?php echo $id ?>">
	<caption>
	Input list for Criteria Items
	</caption>
	<thead>
	<tr>
            <th>Task No</th>
            <th>Subtask No</th>
            <th>Title</th>
            <th>Pass Criteria No</th>
             <th>Max marks</th>
	</tr>
	</thead>
	<tbody>
    <?php if ($items->sub_no == null): ?>
	<tr>
        <td>
                <?php echo CHtml::dropDownList('task_id[]','',
                    CHtml::listData(Task::model()->findAllByAttributes(array('assign_id'=>Yii::app()->session['assign_id'])),'id','task_no'),
                        array('style'=>'width:50px')
                    );
                ?>
                </td>
                
	<td><?php echo CHtml::textField('sub_no[]','',array('style'=>'width:50px')); ?></td>
	<td><?php echo CHtml::textField('title[]','',array('style'=>'width:310px')); ?></td>
        <td>
                <?php echo CHtml::dropDownList('pass_crit_item_id[]','',
                     CHtml::listData(PassCriteriaItem::model()->findAllByAttributes(array('assign_id'=>Yii::app()->session['assign_id'])),'id','item_no'),
                        array('style'=>'width:50px')
                    );
                ?>
                </td>
                <td><?php echo CHtml::textField('max_marks[]','',array('style'=>'width:50px')); ?></td>
        
	</tr>
    <?php else: ?>
        <?php for($i = 0; $i < sizeof($items->sub_no); ++$i): ?>
    	<tr>
        <td>
                <?php echo CHtml::dropDownList('task_id[]','',
                    CHtml::listData(Task::model()->findAllByAttributes(array('assign_id'=>Yii::app()->session['assign_id'])),'id','task_no'),
                        array('style'=>'width:50px')
                    );
                ?>
                </td>
                
	<td><?php echo CHtml::textField('sub_no[]','',array('style'=>'width:50px')); ?></td>
	<td><?php echo CHtml::textField('title[]','',array('style'=>'width:310px')); ?></td>
        <td>
                <?php echo CHtml::dropDownList('pass_crit_item_id[]','',
                     CHtml::listData(PassCriteriaItem::model()->findAllByAttributes(array('assign_id'=>Yii::app()->session['assign_id'])),'id','item_no'),
                        array('style'=>'width:50px')
                    );
                ?>
                </td>
                <td><?php echo CHtml::textField('max_marks[]','',array('style'=>'width:50px')); ?></td>
    	</tr>
        <?php endfor; ?>
	<tr>
        <td>
                <?php echo CHtml::dropDownList('task_id[]','',
                    CHtml::listData(Task::model()->findAllByAttributes(array('assign_id'=>Yii::app()->session['assign_id'])),'id','task_no'),
                        array('style'=>'width:50px')
                    );
                ?>
                </td>
                
	<td><?php echo CHtml::textField('sub_no[]','',array('style'=>'width:50px')); ?></td>
	<td><?php echo CHtml::textField('title[]','',array('style'=>'width:310px')); ?></td>
        <td>
                <?php echo CHtml::dropDownList('pass_crit_item_id[]','',
                     CHtml::listData(PassCriteriaItem::model()->findAllByAttributes(array('assign_id'=>Yii::app()->session['assign_id'])),'id','item_no'),
                        array('style'=>'width:50px')
                    );
                ?>
                </td>
                <td><?php echo CHtml::textField('max_marks[]','',array('style'=>'width:50px')); ?></td>
		</tr>
    <?php endif; ?>
	</tbody>
</table>