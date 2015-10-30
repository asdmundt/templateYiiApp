<?php
$this->breadcrumbs=array(
	'Dokumentes'=>array('index'),
	'erstellen',
);
   $this->docMenu = 1;
    $this->ref_table = 'dokumente';
   $this->ref_id = $model->id;
$this->menu=CMap::mergeArray(
        $this->buttonMenu,
        array(
	array('label'=>Yii::t('DokumenteModule.dokumente', 'List documents'), 'url'=>array('index')),
	array('label'=>Yii::t('DokumenteModule.dokumente', 'Manage documents'), 'url'=>array('admin')),
));
?>


                    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>  