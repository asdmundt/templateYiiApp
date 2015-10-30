<?php

$this->breadcrumbs=array(
	ucfirst($this->module->id)=>array('index'),
	ucfirst($this->getAction()->getId())
);

$this->menu=array(
        array('label'=>Yii::t('KontaktModule.kontakte', 'List contacts'), 'url'=>array('/kontakt/kontakte/index','asDialog'=>2)),
         array('label'=>Yii::t('KontaktModule.kontakte', 'Contact'), 'url'=>array('/kontakt/kontakte/view','id'=>$model->id)),
 
);
?>
<div class="form" id="kontakteForm">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>