

<?php
/*
 $this->widget(
   'CTreeView',
   array('url' => array('/dokumente/dokumente/ajaxFillTree'))
   );

*/
 $this->widget('zii.widgets.grid.CGridView', array(
        'dataProvider' => $activeDataProvider,
        //'cssFile'=> Yii::app()->request->baseUrl.'/css/gridViewStyle/gridView.css',
        'columns' => array('id','name',array(
              'class'=>'CButtonColumn',
          ),

        ),
    ));
?>
 
