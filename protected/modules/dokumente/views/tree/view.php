<?php
$this->breadcrumbs=array(
	'Trees'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List Tree', 'url'=>array('index')),
	array('label'=>'Create Tree', 'url'=>array('create')),
	array('label'=>'Update Tree', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tree', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tree', 'url'=>array('admin')),
);
?>

<h1>View Tree #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'id_parent',
		'title',
		'position',
		'url',
		'icon',
		'model',
	),
)); ?>
