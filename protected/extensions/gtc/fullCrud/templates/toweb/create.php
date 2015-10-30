<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	'$label'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Create'),
);\n";
?>

$this->buttonMenu=array(
	array('label'=>Yii::t('app', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Manage'), 'url'=>array('admin'), 'visible' => Yii::app()->user->isAdmin()),
);
?>


<div class="form">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass)."-form',
	'enableAjaxValidation'=>true,
)); \n"; 

echo "echo \$this->renderPartial('_form', array(
	'model'=>\$model,
	'form' =>\$form
	)); ?>\n"; ?>

<div class="row buttons">
	<?php echo "<?php echo CHtml::submitButton(Yii::t('app', 'Create')); ?>\n"; ?>
</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div>
