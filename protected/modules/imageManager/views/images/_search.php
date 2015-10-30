<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'id'); ?>
                <?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'content'); ?>
                <?php echo $form->textField($model,'content'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'name'); ?>
                <?php echo $form->textField($model,'name',array('size'=>40,'maxlength'=>40)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'endung'); ?>
                <?php echo $form->textField($model,'endung',array('size'=>5,'maxlength'=>5)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'groesse'); ?>
                <?php echo $form->textField($model,'groesse'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'erfassdatum'); ?>
                <?php echo $form->textField($model,'erfassdatum'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'erfassid'); ?>
                <?php echo $form->textField($model,'erfassid'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'status'); ?>
                <?php echo $form->textField($model,'status'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'beschr'); ?>
                <?php echo $form->textArea($model,'beschr',array('rows'=>6, 'cols'=>50)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'imagestree_id'); ?>
                <?php ; ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
