<?php

$this->breadcrumbs=array(
	ucfirst($this->module->id)
);
$this->menu=CMap::mergeArray(
        $this->buttonMenu,
        array(
        array('label'=>Yii::t('KontaktModule.kontakte', 'List contacts'), 'url'=>array('/kontakt/kontakte/index')),
        array('label'=>Yii::t('KontaktModule.kontakte', 'Create contacts'), 'url'=>array('/kontakt/kontakte/create')),
)
    );

?>
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>