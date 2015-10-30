<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bez'); ?>
		<?php echo $form->textField($model,'bez',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'kundennr'); ?>
		<?php echo $form->textField($model,'kundennr',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'titel'); ?>
		<?php echo $form->textField($model,'titel',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'anrede'); ?>
		<?php echo $form->textField($model,'anrede',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>50,'maxlength'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vorname'); ?>
		<?php echo $form->textField($model,'vorname',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'gebdatum'); ?>
		<?php echo $form->textField($model,'gebdatum'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'art'); ?>
		<?php echo $form->textField($model,'art'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'erfassid'); ?>
		<?php echo $form->textField($model,'erfassid',array('size'=>30,'maxlength'=>30)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'erfassdatum'); ?>
		<?php echo $form->textField($model,'erfassdatum'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(Yii::t('app', 'Search'),array('id'=>'bttn30')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->