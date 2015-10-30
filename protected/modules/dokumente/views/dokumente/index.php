<?php
$this->breadcrumbs=array(
	'Dokumente',
);

$this->menu=CMap::mergeArray(
        $this->buttonMenu,
        array(
	array('label'=>Yii::t('DokumenteModule.dokumente', 'Create document'), 'url'=>array('createdialog','asDialog'=>2)),
        array('label'=>'meine Dateien hochladen', 'url'=>array('createdialog','asDialog'=>2)),
	array('label'=>Yii::t('DokumenteModule.dokumente', 'Manage documents'), 'url'=>array('admin','asDialog'=>2)),
));
?>



<?php
/*
 $this->widget(
   'CTreeView',
   array('url' => array('/dokumente/dokumente/ajaxFillTree'))
   );

*/
 $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $activeDataProvider,
        'cssFile'=> Yii::app()->request->baseUrl.'/css/gridViewStyle/gridView.css',
        'columns' => array('id','ref_id','name','ref_table',array(
              'class'=>'CButtonColumn',
        'template'=>'{view}{update}{delete}{info}',//{email}{documents}{print}
         'header' => 'Action',
        'deleteButtonUrl' => 'Yii::app()->createUrl( 
        "/kontakte/delete", 
        array( "id" => $data->primaryKey ) )',    
            'buttons'=>array
            (
                'view'=> array
                (
                    'url'=>'Yii::app()->createUrl("/dokumente/dokumente/view", array("id"=>$data->primaryKey,"asDialog"=>2))',
                    
                 ),
                'update' => array(
                          'url'=>'Yii::app()->createUrl("/dokumente/dokumente/update", array("id"=>$data->primaryKey,"asDialog"=>2))',

                          ),
 
                'info' => array
                (
                    //'label'=>'Send an e-mail to this user',
                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/Information_16x16.png',
                    'url'=>'Yii::app()->createUrl("users/email", array("id"=>$data->primaryKey))',
                ),
               
                  ),

                ),
        ))); ?>
