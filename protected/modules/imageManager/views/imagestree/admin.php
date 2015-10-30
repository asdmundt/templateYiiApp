<?php
$this->breadcrumbs=array(
	'Imagestrees'=>array(Yii::t('app', 'index')),
	Yii::t('app', 'Manage'),
);

$this->buttonMenu=array(
		array('label'=>Yii::t('app', 'List'), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
			);

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('imagestree-grid', {
data: $(this).serialize()
});
				return false;
				});
			");
		?>

<h1> Verwalte&nbsp;Imagestrees</h1>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'imagestree-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'id_parent',
		'title',
		'position',
		'beschr',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
