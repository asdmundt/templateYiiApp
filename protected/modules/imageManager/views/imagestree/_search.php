<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <?php echo $form->label($model,'id'); ?>
                <?php echo $form->textField($model,'id'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'id_parent'); ?>
                <?php echo $form->textField($model,'id_parent'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'title'); ?>
                <?php echo $form->textField($model,'title',array('size'=>25,'maxlength'=>25)); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'position'); ?>
                <?php echo $form->textField($model,'position'); ?>
        </div>

        <div class="row">
                <?php echo $form->label($model,'beschr'); ?>
                <?php echo $form->textArea($model,'beschr',array('rows'=>6, 'cols'=>50)); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
