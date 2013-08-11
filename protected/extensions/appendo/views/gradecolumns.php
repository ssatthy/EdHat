<table class="appendo-gii" id="<?php echo $id ?>">
	<caption>
	Input list for grade columns
	</caption>
	<thead>
	<tr>
            <th>Field</th>
            <th>Marks</th>
            <th>Comment</th>
	</tr>
	</thead>
	<tbody>
    <?php if ($columns->field == null): ?>
	<tr>
	<td><?php echo CHtml::textField('field[]','',array('style'=>'width:120px')); ?></td>
        <td><?php echo CHtml::textField('marks[]','',array('style'=>'width:90px')); ?></td>
	<td><?php echo CHtml::textField('description[]','',array('style'=>'width:310px')); ?></td>
	</tr>
    <?php else: ?>
        <?php for($i = 0; $i < sizeof($columns->field); ++$i): ?>
    	<tr>
    	<td><?php echo CHtml::textField('field[]','',array('style'=>'width:120px')); ?></td>
        <td><?php echo CHtml::textField('marks[]','',array('style'=>'width:90px')); ?></td>
	<td><?php echo CHtml::textField('description[]','',array('style'=>'width:310px')); ?></td>
    	</tr>
        <?php endfor; ?>
	<tr>
	<td><?php echo CHtml::textField('field[]','',array('style'=>'width:120px')); ?></td>
        <td><?php echo CHtml::textField('marks[]','',array('style'=>'width:90px')); ?></td>
	<td><?php echo CHtml::textField('description[]','',array('style'=>'width:310px')); ?></td>
		</tr>
    <?php endif; ?>
	</tbody>
</table>