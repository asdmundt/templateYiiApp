<?php
$this->breadcrumbs=array(
	'Lesezeichens'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

	$this->boxMenu=array(
	array('label'=>Yii::t('app', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
	array('label'=>Yii::t('app', 'View'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Manage'), 'url'=>array('admin'), 'visible' => Yii::app()->user->isAdmin()),

	);
	?>

	<h1>Update Lesezeichen <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>