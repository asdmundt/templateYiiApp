<div class="well well-small">
	  <?php echo $model->name; ?>
	</div>
<?php /** @var BootActiveForm $form */
	$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
		'id'=>'horizontalForm',
		'type'=>'vertical',
	)); ?>
 
<?php echo $form->hiddenField($model, 'act'); ?> 
<?php echo $form->hiddenField($model, 'path'); ?> 
<?php echo $form->hiddenField($model, 'grid_id'); ?> 
<?php 
if (($model->mimeType == "htm") || ($model->mimeType == "html") ){
    echo $form->ckEditorRow($model, 'fileContent', array('options'=>array('fullpage'=>'js:true')));
    
}  else {
    $this->widget('application.extensions.editarea.EEditArea', array(
		'name'=>'fileContent',
	        'value'=>$model->fileContent,
                'model'=>$model,
                'form'=>$form,
                'attribute'=>'fileContent',
		'htmlOptions'=>array(
			'syntax'=>$model->mimeType,
			'allow_toggle'=>'true'
				)
																	)
				);
    
 
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.

$this->widget('application.extensions.editarea.EEditArea', array(
		'name'=>'fileContent',
	        'value'=>$model->fileContent,
                'model'=>$model,
                'form'=>$form,
                'attribute'=>'fileContent',
		'htmlOptions'=>array(
			'syntax'=>$model->mimeType,
			'allow_toggle'=>'true'
				)
																	)
				);
 */
    
?>
 <div class="form-actions">
        <?php $this->widget('booster.widgets.TbButton', array('buttonType'=>'submit', 'context'=>'success','size' => 'mini', 'label'=>'ok')); ?>
        <?php $this->widget('booster.widgets.TbButton', array('buttonType'=>'reset','size' => 'mini', 'label'=>'Reset')); ?>
    </div>
<?php }$this->endWidget(); ?>