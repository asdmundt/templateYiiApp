<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

		<?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

		<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>30)); ?>

		<?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>50)); ?>

		<?php echo $form->textFieldRow($model,'host',array('class'=>'span5','maxlength'=>30)); ?>

		<?php echo $form->textFieldRow($model,'username',array('class'=>'span5','maxlength'=>30)); ?>

		<?php echo $form->textFieldRow($model,'pwd',array('class'=>'span5','maxlength'=>30)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
