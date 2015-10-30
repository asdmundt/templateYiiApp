

<?php echo $form->errorSummary($model); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
                       
					<td width="50%"><?php echo $form->labelEx($model,'id_parent'); ?>
</td>
			<td width="50%"><?php echo $form->textField($model,'id_parent'); ?>
			<?php echo $form->error($model,'id_parent'); ?>
</td>
		
	</tr>

	<tr>
                       
					<td width="50%"><?php echo $form->labelEx($model,'title'); ?>
</td>
			<td width="50%"><?php echo $form->textField($model,'title',array('size'=>25,'maxlength'=>25)); ?>
			<?php echo $form->error($model,'title'); ?>
</td>
		
	</tr>

	<tr>
                       
					<td width="50%"><?php echo $form->labelEx($model,'position'); ?>
</td>
			<td width="50%"><?php echo $form->textField($model,'position'); ?>
			<?php echo $form->error($model,'position'); ?>
</td>
		
	</tr>

	<tr>
                       
					<td width="50%"><?php echo $form->labelEx($model,'beschr'); ?>
</td>
			<td width="50%"><?php echo $form->textArea($model,'beschr',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'beschr'); ?>
</td>
		
	</tr>

</table>
