<?php
$this->breadcrumbs=array(
	'Dokumentes'=>array('index'),
	'Manage',
);

$this->menu=CMap::mergeArray(
        $this->buttonMenu,
        array(
	array('label'=>Yii::t('DokumenteModule.dokumente', 'List documents'), 'url'=>array('index')),
	array('label'=>'Dokument erstellen', 'url'=>array('create')),
));

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('dokumente-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'dokumente-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'ref_id',
		'pfad',
		'name',
		'erfassdatum',
		'erfassid',
		/*
		'STATUS',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
