
<fieldset>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
          'id' => 'img-form',
          'enableAjaxValidation' => false,
            //This is very important when uploading files
          'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
      ?>    
        <div class="row">
            <?php echo $form->labelEx($model,'beschr'); ?>
            <?php echo $form->textField($model,'beschr'); ?>
            <?php echo $form->error($model,'beschr'); ?>
        </div>
        <!-- Other Fields... -->
        <div class="row">
            <?php echo $form->labelEx($model,'file'); ?>
            <?php
            $this->widget( 'xupload.XUpload', array(
                'url' => Yii::app( )->createUrl( "/controller/upload"),
                //our XUploadForm
                'model' => $photos,
                //We set this for the widget to be able to target our own form
                ' ' => array('id'=>'somemodel-form'),
                'attribute' => 'file',
                'multiple' => true,
                //Note that we are using a custom view for our widget
                //Thats becase the default widget includes the 'form' 
                //which we don't want here
               // 'formView' => 'application.modules.imageManager.views.images.multiupload',
            
        ));
            ?>
        </div>
        <?php echo $form->hiddenField($model,'imagestree_id'); ?>
        <button type="submit">Submit</button>
    <?php $this->endWidget(); ?>
</fieldset>