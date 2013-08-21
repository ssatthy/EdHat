<table class="appendo-gii" id="<?php echo $id ?>">
	<caption>
	Input list for Task
	</caption>
	<thead>
	<tr>
            <th>Learning Outcome</th>
            <th>Task No</th>
	</tr>
	</thead>
	<tbody>
    <?php if ($items->task_no == null): ?>
	<tr>
            <td>
                <?php echo CHtml::dropDownList('lo_id[]','',
                    CHtml::listData(LearningOC::model()->findAllByAttributes(array('unitid'=>Yii::app()->session['module_id'])),'lerocid','title'),
                        array('style'=>'width:300px')
                    );
                ?>
                </td>
	<td><?php echo CHtml::textField('task_no[]','',array('style'=>'width:120px')); ?></td>
	
	</tr>
    <?php else: ?>
        <?php for($i = 0; $i < sizeof($items->task_no); ++$i): ?>
    	<tr>
            <td>
                <?php echo CHtml::dropDownList('lo_id[]','',
                    CHtml::listData(LearningOC::model()->findAllByAttributes(array('unitid'=>Yii::app()->session['module_id'])),'lerocid','title'),
                        array('style'=>'width:300px')
                    );
                ?>
                </td>
    	<td><?php echo CHtml::textField('task_no[]','',array('style'=>'width:120px')); ?></td>
	
    	</tr>
        <?php endfor; ?>
	<tr>
            <td>
                <?php echo CHtml::dropDownList('lo_id[]','',
                    CHtml::listData(LearningOC::model()->findAllByAttributes(array('unitid'=>Yii::app()->session['module_id'])),'lerocid','title'),
                        array('style'=>'width:300px')
                    );
                ?>
                </td>
	<td><?php echo CHtml::textField('task_no[]','',array('style'=>'width:120px')); ?></td>
	
		</tr>
    <?php endif; ?>
	</tbody>
</table>