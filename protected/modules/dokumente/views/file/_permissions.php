<?php

/**
 * This is the form view for rename files or dir
 * 
 * @name _rename.php
 * @package module.dokumente.views.file
 * @category Dokumenten Verwaltung
 * @author Söhnke Mundt
  */
?>

<div class="wide form">

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'permissionsForm',
                    'enableAjaxValidation' => true,
                        ));
                ?>
                <p class="note">
                </p>
                <?php echo $form->errorSummary($model); ?>

                <div class="row">
                    <?php echo $form->labelEx($model, 'permissions'); ?>
                    <?php echo $form->textField($model, 'permissions', array('size' => 20, 'maxlength' => 20)); ?>
                    <?php echo $form->error($model, 'permissions'); ?>
                </div>
                <div class="row buttons" >
                    <?php echo $form->hiddenField($model, 'path'); ?> 
                     <?php 
                          echo $form->hiddenField($model, 'act', array('id' => 'action')); 
                         echo $form->hiddenField($model, 'name');
                     
                     echo CHtml::ajaxSubmitButton('Submit', CHtml::normalizeUrl(array('/dokumente/file/updatedialog', 'render' => false)),array('success'=>'js: function(data) {
                             $("#updateDialog").dialog("close");$.fn.yiiGridView.update("gridfileright");$.fn.yiiGridView.update("gridfileleft");}'),array('class' => 'btn btn-small','onclick'=>'$("#action").val("permissions");', 'id' => 'cfsubmit'.uniqid(), 'live'=>false)); ?>               

                    <?php echo CHtml::htmlButton('<i class="icon-ban-circle"></i> Reset', array('class' => 'btn btn-small', 'type' => 'reset','onclick'=>'$("#updateDialog").dialog("close");')); ?>
                </div>


                <?php $this->endWidget(); ?>

          </div>
