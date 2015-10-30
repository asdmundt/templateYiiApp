<?php
$this->breadcrumbs=array(
	'Imagestrees'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);

$this->buttonMenu=array(
	array('label'=>Yii::t('app', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Manage'), 'url'=>array('admin'), 'visible' => Yii::app()->user->isAdmin()),
);
?>


<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'imagestree-form',
	'enableAjaxValidation'=>true,
)); 
echo $this->renderPartial('_form', array(
	'model'=>$model,
	'form' =>$form
	)); ?>

<div class="row buttons">
	<?php echo CHtml::submitButton(Yii::t('app', 'Create')); ?>
</div>

<?php $this->endWidget(); ?>

</div>
