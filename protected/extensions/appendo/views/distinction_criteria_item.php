<table class="appendo-gii" id="<?php echo $id ?>">
	<caption>
	Input list for Criteria Items
	</caption>
	<thead>
	<tr>
            <th>Criteria No</th>
            <th>Criteria Item No</th>
            <th>Title</th>
	</tr>
	</thead>
	<tbody>
    <?php if ($items->item_no == null): ?>
	<tr>
        <td>
                <?php echo CHtml::dropDownList('distn_id[]','',
                    CHtml::listData(DistinctionCriteria::model()->findAllByAttributes(array('unit_id'=>Yii::app()->session['module_id'])),'id','criteria_no'),
                        array('style'=>'width:100px')
                    );
                ?>
                </td>
                
	<td><?php echo CHtml::textField('item_no[]','',array('style'=>'width:120px')); ?></td>
	<td><?php echo CHtml::textField('title[]','',array('style'=>'width:310px')); ?></td>
	</tr>
    <?php else: ?>
        <?php for($i = 0; $i < sizeof($items->item_no); ++$i): ?>
    	<tr>
        <td>
                <?php echo CHtml::dropDownList('distn_id[]','',
                     CHtml::listData(DistinctionCriteria::model()->findAllByAttributes(array('unit_id'=>Yii::app()->session['module_id'])),'id','criteria_no'),
                        array('style'=>'width:100px')
                    );
                ?>
                </td> 
    	<td><?php echo CHtml::textField('item_no[]','',array('style'=>'width:120px')); ?></td>
	<td><?php echo CHtml::textField('title[]','',array('style'=>'width:310px')); ?></td>
    	</tr>
        <?php endfor; ?>
	<tr>
        <td>
                <?php echo CHtml::dropDownList('distn_id[]','',
                     CHtml::listData(DistinctionCriteria::model()->findAllByAttributes(array('unit_id'=>Yii::app()->session['module_id'])),'id','criteria_no'),
                        array('style'=>'width:100px')
                    );
                ?>
                </td>
	<td><?php echo CHtml::textField('item_no[]','',array('style'=>'width:120px')); ?></td>
	<td><?php echo CHtml::textField('title[]','',array('style'=>'width:310px')); ?></td>
		</tr>
    <?php endif; ?>
	</tbody>
</table>