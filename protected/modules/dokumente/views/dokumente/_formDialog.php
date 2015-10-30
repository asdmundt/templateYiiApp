<?php 

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'dokumente-dialog',
	'enableAjaxValidation'=>true,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>
        <div id="test"></div>  
	<div class="row">
		<?php echo $form->labelEx($model,'ref_id'); ?>
		<?php echo $form->textField($model,'ref_id',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'ref_id'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>


	<div class="row">
         
          </div>

	<div class="row buttons">
                <?php echo $form->hiddenField($model,'ref_table'); ?>
                <?php echo $form->hiddenField($model,'tree_id'); ?>
		<?php echo CHtml::ajaxSubmitButton('ok',CHtml::normalizeUrl(array('/dokumente/dokumente/createdialog','render'=>false)),array('success'=>'js: function(data) {
                        $("#documentDialog").dialog("close");
                    }'),array('id'=>'closeDocumentDialog','class'=>'submitbttn','disabled'=>'disabled')); ?>

	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<div>
      <?php 
         $this->widget('EAjaxUpload',
                                 array(
                                       'id'=>'uploadFile',
                                       'config'=>array(
                                                       'action'=>Yii::app()->createUrl('/dokumente/dokumente/upload',array('ref_id'=>$model->ref_id, 'ref_table'=>$model->ref_table,'id'=>$model->getpk())),
                                                       'allowedExtensions'=>array("svg", "txt", "doc", "docx", "odt", "rtf", "xml", "xls","jpg","jpeg","gif","doc","pdf","ini","html","php","cfg","conf","htm"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                                       'sizeLimit'=>100*1024*1024,// maximum file size in bytes
                                                       //'minSizeLimit'=>1*1024*1024,// minimum file size in bytes
                                                       'onComplete'=>"js:function(id, fileName, responseJSON){ alert(responseJSON.path);$('#Dokumente_name').val(fileName);$('#Dokumente_pfad').val(responseJSON.path);$('#closeDocumentDialog').removeAttr('disabled'); }",
                                                                                                            )
                                      ));
         ?>
          </div>