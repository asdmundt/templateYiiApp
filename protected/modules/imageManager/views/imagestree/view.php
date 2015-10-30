<?php
$this->breadcrumbs=array(
	'Imagestrees'=>array('index'),
	$model->id,
);
$this->buttonMenu=array(
	array('label'=>Yii::t('app', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
        array('label'=>Yii::t('app', 'Update'), 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'View'), 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('app', 'Delete'), 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
        array('label'=>Yii::t('app', 'Manage'), 'url'=>array('admin'), 'visible' => Yii::app()->user->isAdmin()),
);

?>

<h1>View Imagestree #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_parent',
		'title',
		'position',
		'beschr',
	),
)); ?>


