<?php
$this->breadcrumbs=array(
	ucfirst($this->module->id)=>array('index'),
	ucfirst($this->getAction()->getId())
);

$this->menu=array(
	array('label'=>Yii::t('KontaktModule.kontakte', 'List contacts'), 'url'=>array('index')),
	array('label'=>Yii::t('KontaktModule.kontakte', 'Create contacts'), 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('kontakte-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>




<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'kontakte-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'bez',
		'kundennr',
		'titel',
		'anrede',
		'name',
		/*
		'vorname',
		'gebdatum',
		'art',
		'erfassid',
		'erfassdatum',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
