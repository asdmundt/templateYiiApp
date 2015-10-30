
    <div class="wide form">

                <?php
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'fileForm',
                    'enableAjaxValidation' => FALSE,
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
                     if($model->act == "rename")
                         echo $form->hiddenField($model, 'oldname');
                     ?>
                    <?php echo CHtml::ajaxSubmitButton('Submit', CHtml::normalizeUrl(array('/dokumente/file/updatedialog', 'render' => false)),array('success'=>'js: function(data) {
                             $("#updateDialog").dialog("close");}'),array('class' => 'btn btn-primary btn-mini', 'id' => 'cfsubmit'.uniqid(), 'live'=>false)); ?>               

                    <?php echo CHtml::htmlButton('<i class="icon-ban-circle"></i> Reset', array('class' => 'btn btn-primary btn-mini', 'type' => 'reset','onclick'=>'$("#documentDialog").dialog("close");')); ?>
                </div>


                <?php $this->endWidget(); ?>

          </div>

