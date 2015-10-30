<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'mydialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'Selected Item',
        'autoOpen'=>false,
        'width'=>400,
    ),
)); ?>

<div class="form" id="DDMediaActionFormContainer">
<?php echo CHtml::beginForm('','post',array('enctype' => 'multipart/form-data')); ?>

    <p class="msg" style="display:none"></p>

    <?php echo CHtml::errorSummary($model); ?>
 
    <?php echo CHtml::activeHiddenField($model,'path') ?>
    <?php echo CHtml::activeHiddenField($model,'mediaType') ?>
    <?php echo CHtml::activeHiddenField($model,'action'); ?>
 
    <?php echo CHtml::activeHiddenField($model,'oldName') ?>

    <div class="simple" id="nameRow" style="display:none">
        <?php echo CHtml::activeLabel($model,'name'); ?>
        <?php echo CHtml::activeTextField($model,'name') ?>
    </div>
 
    <div class="simple" id="multipleNamesRow" style="display:none">
        <?php echo CHtml::activeLabel($model,'multipleNames'); ?>
        <?php echo CHtml::activeTextArea($model,'multipleNames', array( 'rows'=>5 )) ?>
    </div>
 
    <div class="simple" id="nameRowDisplayOnly" style="display:none">
        <?php echo CHtml::activeLabel($model,'name'); ?>
        <?php //echo CHtml::activeHiddenField($model,'name') ?>
        <span id="selectedItemName"></span>
    </div>
 
    <div class="simple" id="p1Row" style="display:none">
        <?php echo CHtml::activeLabel($model,'p1'); ?>
        <?php echo CHtml::activeTextField($model,'p1'); ?>
    </div>

    <div class="simple" id="uploadedFileRow" style="display:none">
        <?php echo CHtml::activeLabel($model,'uploadedFile'); ?>
        <?php echo CHtml::activeFileField($model,'uploadedFile'); ?>
    </div>

    <div class="simple submit">
        <?php echo CHtml::submitButton('Submit', array('id'=>'mediaActionSubmitButton')); ?>
        <?php echo CHtml::button('Cancel',array('onclick'=>"jQuery('#mydialog').dialog('close');")); ?>
    </div>
 
<?php echo CHtml::endForm(); ?>
</div><!-- form -->

<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<?php 
if(count($model->errors)>0) Yii::app()->clientScript->registerScript('showMediaActionForm','showDialog("'.$model->action.'");');
?>

