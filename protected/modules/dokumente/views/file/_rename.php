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
                    'id' => 'renameForm',
                    'enableAjaxValidation' => true,
                        ));
                ?>


                <p class="note">

                </p>
                <?php echo $form->errorSummary($model); ?>

                <div class="row">
                    <?php echo $form->labelEx($model, 'name'); ?>
                    <?php echo $form->textField($model, 'name', array('size' => 20, 'maxlength' => 20)); ?>
                    <?php echo $form->error($model, 'name'); ?>
                </div>
                <div class="row buttons" >
                    <?php echo $form->hiddenField($model, 'dir'); ?> 
                     <?php echo $form->hiddenField($model, 'act');
                    
                         echo $form->hiddenField($model, 'oldname');
                     
                     echo CHtml::ajaxSubmitButton('Submit', CHtml::normalizeUrl(array('/dokumente/file/updatedialog', 'render' => false)),array('success'=>'js: function(data) {
                             $("#updateDialog").dialog("close");}'),array('class' => 'btn btn-small','onclick'=>'$("#act").val("rename");', 'id' => 'cfsubmit'.uniqid(), 'live'=>false)); ?>               

                    <?php echo CHtml::htmlButton('<i class="icon-ban-circle"></i> Reset', array('class' => 'btn btn-small', 'type' => 'reset','onclick'=>'$("#updateDialog").dialog("close");')); ?>
                </div>


                <?php $this->endWidget(); ?>

          </div>
