

<?php echo $form->errorSummary($model); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
                       
					<td width="50%"><?php echo $form->labelEx($model,'content'); ?>
</td>
			<td width="50%"><?php echo $form->textField($model,'content'); ?>
			<?php echo $form->error($model,'content'); ?>
</td>
		
	</tr>

	<tr>
                       
					<td width="50%"><?php echo $form->labelEx($model,'name'); ?>
</td>
			<td width="50%"><?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>40)); ?>
			<?php echo $form->error($model,'name'); ?>
</td>
		
	</tr>

	<tr>
                       
					<td width="50%"><?php echo $form->labelEx($model,'endung'); ?>
</td>
			<td width="50%"><?php echo $form->textField($model,'endung',array('size'=>5,'maxlength'=>5)); ?>
			<?php echo $form->error($model,'endung'); ?>
</td>
		
	</tr>

	<tr>
                       
					<td width="50%"><?php echo $form->labelEx($model,'groesse'); ?>
</td>
			<td width="50%"><?php echo $form->textField($model,'groesse'); ?>
			<?php echo $form->error($model,'groesse'); ?>
</td>
		
	</tr>

	<tr>
                       
					<td width="50%"><?php echo $form->labelEx($model,'erfassdatum'); ?>
</td>
			<td width="50%"><?php echo $form->textField($model,'erfassdatum'); ?>
			<?php echo $form->error($model,'erfassdatum'); ?>
</td>
		
	</tr>

	<tr>
                       
					<td width="50%"><?php echo $form->labelEx($model,'erfassid'); ?>
</td>
			<td width="50%"><?php echo $form->textField($model,'erfassid'); ?>
			<?php echo $form->error($model,'erfassid'); ?>
</td>
		
	</tr>

	<tr>
                       
					<td width="50%"><?php echo $form->labelEx($model,'status'); ?>
</td>
			<td width="50%"><?php echo $form->textField($model,'status'); ?>
			<?php echo $form->error($model,'status'); ?>
</td>
		
	</tr>

	<tr>
                       
					<td width="50%"><?php echo $form->labelEx($model,'beschr'); ?>
</td>
			<td width="50%"><?php echo $form->textArea($model,'beschr',array('rows'=>6, 'cols'=>50)); ?>
			<?php echo $form->error($model,'beschr'); ?>
</td>
		
	</tr>

	<tr>
                       
		
	</tr>

</table>
<label for="Images">Belonging Images</label><?php 
					$this->widget('application.components.Relation', array(
							'model' => $model,
							'relation' => 'imagestree',
							'fields' => 'content',
							'allowEmpty' => true,
							'style' => 'dropdownlist',
							)
						); ?>
			