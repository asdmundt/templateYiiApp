<div class="row-fluid">
    <div class="span3">
       <?php 
       $this->widget('application.modules.dokumente.extensions.cfilebrowser.CFileBrowserWidget', array(
                        'script' => array('dokumente/file/filebrowser'),
                        //'root' => Yii::app()->params["uploadDir"] . 'mandant' . Yii::app()->params["mandantId"] . '/files/',
                        'root' => '/',
                        'folderEvent' => 'click',
                        'expandSpeed' => 1000,
                        'collapseSpeed' => 1000,
                        'multiFolder' => false, 
                        'outputName' => '#DDMediaAction_p1',     
                        'loadMessage' => 'File Browser Is Loading...hang on a sec',
                        'folderCallback' => true,
                        'callbackFunction'=>'updateDir(f);'      
                        
                    ));
       ?>
    </div>
    <div class="span9">
    <div class="form">

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'cf-form',
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
                     <?php echo $form->hiddenField($model, 'formaction');
                     if($model->formaction == "rename")
                         echo $form->hiddenField($model, 'oldname');
                     ?>
                    <?php echo CHtml::ajaxSubmitButton('Submit', CHtml::normalizeUrl(array('/dokumente/file/updatedialog', 'render' => false)),array('success'=>'js: function(data) {
                             $("#documentDialog").dialog("close");}'),array('class' => 'btn btn-primary btn-mini', 'id' => 'cfsubmit'.uniqid(), 'live'=>false)); ?>               

                    <?php echo CHtml::htmlButton('<i class="icon-ban-circle"></i> Reset', array('class' => 'btn btn-primary btn-mini', 'type' => 'reset','onclick'=>'$("#documentDialog").dialog("close");')); ?>
                </div>


                <?php $this->endWidget(); ?>

          </div>
    </div>
</div>
