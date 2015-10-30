<?php
$this->breadcrumbs = array(
 ucfirst($this->module->id)=>array('index'),
	ucfirst($this->getAction()->getId())
);

$this->menu=array(
        array('label'=>Yii::t('KontaktModule.kontakte', 'List contacts'), 'url'=>array('/kontakt/kontakte/index','asDialog'=>2)),
         array('label'=>Yii::t('KontaktModule.kontakte', 'Contact'), 'url'=>array('/kontakt/kontakte/view','id'=>$model->id,'asDialog'=>2)),
 
);

$this->pageTitle = title( 'Delete ' . $model->name );
?>

<h2>
  Are you sure you want to delete location:
  <?php echo CHtml::encode( $model->name ); ?>?
</h2>

<?php $form = $this->beginWidget( 'CActiveForm', array(
  'id' => 'location-delete-form',
  'enableAjaxValidation' => false,
  'focus' => '#confirmDelete',
)); ?>

<div class="buttons">
  <?php 
  echo CHtml::submitButton( 'Yes', array( 'name' => 'confirmDelete', 
    'id' => 'confirmDelete' ) );
  echo CHtml::submitButton( 'No', array( 'name' => 'denyDelete' ) ); 
  ?>

  <?php
  /* !!! Or you can use jQuery UI buttons, makes no difference !!!
  $this->widget( 'zii.widgets.jui.CJuiButton', array(
    'name' => 'confirmDelete',
    'caption' => 'Yes',
  ));
  $this->widget( 'zii.widgets.jui.CJuiButton', array(
    'name' => 'denyDelete',
    'caption' => 'No',
  ));*/
  ?>
</div>

<?php $this->endWidget(); ?>