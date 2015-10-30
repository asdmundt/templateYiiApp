
<div class="wide form">


<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'dokumente-form',
	'enableAjaxValidation'=>true,
)); ?>
        
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
<div class="row">

	</div>
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
            <?php echo $form->labelEx($model,'status'); ?>
            <?php
         
            echo CHtml::activeDropDownList($model,'status', array(
                0 => Yii::t('DokumenteModule.dokumente', 'privat'),
                1 => Yii::t('DokumenteModule.dokumente', 'my usergroups'),
                2 => Yii::t('DokumenteModule.dokumente', 'selected usergroup'),
                3 => Yii::t('DokumenteModule.dokumente', 'public'),    
                )); 

            ?>
            <?php printf('<p class="tooltip">%s</p>', Yii::t('DokumenteModule.dokumente', 'If privat is set, only the owner can see the dokument. If privat is set, only the owner can see the dokument')); ?>
            <?php echo $form->error($model,'preserveProfiles'); ?>
            

          </div>
         <?php if(!$model->isNewRecord){ ?>
           <?php if($model->status = 2){ ?>
            <div class="row">
		<?php echo CHtml::label(Yii::t('DokumenteModule.dokumente', 'available'),false); ?>
            </div>		
                <?php $this->widget('Relation', array(
				'model' => $model,
				'relation' => 'docgroups',
				'style' => 'dropdownlist',
				'fields' => 'title',
            			'htmlOptions' => array(
				'checkAll' => Yum::t('Choose All'),
				'template' => '<div class="row">{input}</div><div class="row">{label}</div>'),
			'showAddButton' => false
				));  ?>
	
<?php } ?>
        <div class="row">
		<?php echo CHtml::label(Yii::t('DokumenteModule.dokumente', 'selected usergroup'),false); ?>
		<?php 
 $this->widget('EAjaxUpload',
                                 array(
                                       'id'=>'uploadFile',
                                       'config'=>array(
                                                       'action'=>Yii::app()->createUrl('dokumente/dokumente/upload',array('ref_id'=>$model->ref_id, 'ref_table'=>'dokumente','id'=>$model->id)),
                                                       'allowedExtensions'=>array("svg", "txt", "doc", "docx", "odt", "rtf", "xml", "xls","jpg","jpeg","gif","doc","pdf","ini","html","php"),//array("jpg","jpeg","gif","exe","mov" and etc...
                                                       'sizeLimit'=>100*1024*1024,// maximum file size in bytes
                                                       //'minSizeLimit'=>1*1024*1024,// minimum file size in bytes
                                                       'onComplete'=>"js:function(id, fileName, responseJSON){ alert(responseJSON.path);$('#Dokumente_name').val(fileName);$('#Dokumente_pfad').val(responseJSON.path); }",
                                                      // 'succes'=>""
                                                /*
                                                        'messages'=>array(
                                                                         'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
                                                                         'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
                                                                         'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
                                                                         'emptyError'=>"{file} is empty, please select files again without it.",
                                                                       'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."Dokumente_pfad
                                                                        ),
                                                       'showMessage'=>"js:function(message){ alert(message); }"
                                                      
                                                        */
                                                      )
                                      ));
 ?>
	</div> 
        <?php } ?>
	<div class="row buttons">
                <?php echo $form->hiddenField($model,'ref_table'); ?>
                
                <div class="row buttons">
		<?php echo CHtml::submitButton('ok',array('id'=>'bttn')); ?>
	</div>        
                
	</div>

<?php $this->endWidget(); ?>

</div><!-- form echo CHtml::label(Yum::t('Having'), 'search_role') -->
