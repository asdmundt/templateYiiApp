<?php
$this->breadcrumbs=array(
	'Dokumentes'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

   $this->docMenu = 1;
   $this->ref_table = 'dokumente';
   $this->ref_id = $model->id;

$this->menu=CMap::mergeArray(
        $this->buttonMenu,
        array(
	array('label'=>Yii::t('DokumenteModule.dokumente', 'List documents'), 'url'=>array('index')),
	array('label'=>Yii::t('DokumenteModule.dokumente', 'Create document'), 'url'=>array('create')),
	array('label'=>'Dokument anzeigen', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>Yii::t('DokumenteModule.dokumente', 'Manage documents'), 'url'=>array('admin')),
));
?>

<div class="detailcontent">
        <div class="detailcontent-decoration">
            <div class="detailcontent-left"></div>
            <div class="detailcontent-right"></div>
        </div>
            <div class="detailcontent-content">

                    <?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
                
            </div>
   </div>