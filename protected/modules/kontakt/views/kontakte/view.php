<?php
 if ( array_key_exists ( 'dokumente', Yii::app()->modules ) ){
   $this->docMenu = 1;
    $this->ref_table = $model->tableName();
   $this->ref_id = $model->id;
}
  $i=0;

        $items[$i]['label']=Yii::t('KontaktModule.kontakte', 'List contacts');
        $items[$i]['url']=array('index');
 /*       $i++;
        $items[$i]['label']=Yii::t('KontaktModule.kontacts', 'Contact');
            $x=0;
            $items[$i]['items'][$x]['label']=Yii::t('KontaktModule.adresse', 'List related adresses');
            $items[$i]['items'][$x]['url']=array('/kontakt/adresse/index', 'kontakte_id' => $model->id,'asDialog'=>2);
            $x++;
            $items[$i]['items'][$x]['label']=Yii::t('KontaktModule.bankdaten', 'List related bankingdata');
            $items[$i]['items'][$x]['url']=array('/kontakt/bankdaten/index', 'kontakte_id' => $model->id,'asDialog'=>2);
            $x++;
            $items[$i]['items'][$x]['label']=Yii::t('KontaktModule.kommunikation', 'List related communikationdata');
            $items[$i]['items'][$x]['url']=array('/kontakt/kommunikation/index', 'kontakte_id' => $model->id,'asDialog'=>2);
   */         $i++;
  $this->menu=$items;


$this->widget('ext.slidetoggle.ESlidetoggle', array(
    //'collapsed' => '.portlet', //uncomment to show all collapsed
    'arrow' => false, //comment to show the toggle arrow
));

$this->breadcrumbs = array(
   ucfirst($this->module->id)=>array('index'),
	ucfirst($this->getAction()->getId())
);

?>


        <div class="wide form">
            
             <div class="btn-toolbar">
    <?php $this->widget('bootstrap.widgets.TbButtonGroup', array(
         // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
        'size'=>'mini',
        'buttons'=>array(
            array('label'=>Yii::t('app', 'Create'),'type'=>'success', 'icon'=>'icon-plus-sign icon-white','url' => array('create','asDialog'=>1)),//'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
            array('label'=>Yii::t('app', 'Update'),'type'=>'success', 'icon'=>'icon-pencil icon-white','url' => array('update','id'=>$model->id,'asDialog'=>2)),
            array('label'=>Yii::t('app', 'Delete'),'type'=>'danger', 'icon'=>'icon-minus-sign icon-white','url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
         ),
    )); ?>
</div>                                      
                           

             <?php echo $this->renderPartial('_detailview', array('model'=>$model)); ?>
        </div>
