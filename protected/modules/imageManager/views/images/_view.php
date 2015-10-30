<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('endung')); ?>:</b>
	<?php echo CHtml::encode($data->endung); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('groesse')); ?>:</b>
	<?php echo CHtml::encode($data->groesse); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('erfassdatum')); ?>:</b>
	<?php echo CHtml::encode($data->erfassdatum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('erfassid')); ?>:</b>
	<?php echo CHtml::encode($data->erfassid); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('beschr')); ?>:</b>
	<?php echo CHtml::encode($data->beschr); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('imagestree_id')); ?>:</b>
	<?php echo CHtml::encode($data->imagestree_id); ?>
	<br />

	*/ ?>

</div>
