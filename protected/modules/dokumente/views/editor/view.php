<?php
$this->breadcrumbs=array(
	'Dokumente'=>array('index'),
	$model->name,
);
$this->docMenu = 2;
    $this->ref_table = 'kontakte';
   $this->ref_id = $model->id;
$this->menu=CMap::mergeArray(
        $this->buttonMenu,
        array(
	array('label'=>Yii::t('DokumenteModule.dokumente', 'List documents'), 'url'=>array('index')),
	//array('label'=>'Dokument erstellen', 'url'=>array('create')),
	array('label'=>'Dokument bearbeiten', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Dokument entfernen', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('DokumenteModule.dokumente', 'Manage documents'), 'url'=>array('admin')),
));
?>

 

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
        'cssFile'=> Yii::app()->request->baseUrl.'/css/detailview/graystyles.css',
	'attributes'=>array(
		'id',
		'ref_id',
		'pfad',
		'name',
		'erfassdatum',
		'erfassid',
		'status',
	),
)); ?>

