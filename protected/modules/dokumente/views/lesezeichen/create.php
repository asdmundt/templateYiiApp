<?php
$this->breadcrumbs=array(
	'Lesezeichens'=>array('index'),
	'Create',
);

$this->boxMenu=array(
	array('label'=>Yii::t('app', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Manage'), 'url'=>array('admin'), 'visible' => Yii::app()->user->isAdmin()),

);
?>

<h1>Create Lesezeichen</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>