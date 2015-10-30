<?php  
$viewButtonMenu = array(
            array('label' => '&nbsp;&nbsp;<img src="' . Yii::app()->theme->getBaseUrl() . '/css/illustration.png" alt="info" class="imgButton">&nbsp;&nbsp;', 'url' => array('/dokumente/file/multiupload', 'act' => 'upload'), 'encodeLabel' => false, 'htmlOptions' =>array('title' => Yii::t('KontaktModule.kontakte', 'Create contacts'))),
            array('label' => '&nbsp;&nbsp;<img src="' . Yii::app()->theme->getBaseUrl() . '/css/contact.png" alt="info" class="imgButton">&nbsp;&nbsp;', 'url' => array('/dokumente/file/multiupload', 'act' => 'upload'), 'encodeLabel' => false, 'htmlOptions' =>array('title' => 'openDlg')),
            array('label' => '&nbsp;&nbsp;<img src="' . Yii::app()->theme->getBaseUrl() . '/css/document-library.png" alt="info" class="imgButton">&nbsp;&nbsp;', 'url' => array('/dokumente/file/multiupload', 'act' => 'upload'), 'encodeLabel' => false, 'htmlOptions' =>array('title' => 'openDlg')),
        );
$this->beginWidget('TwPortlet', array(
            'title' => '<b>'.CHtml::encode($data->getAttributeLabel('kundennr')).
    ':</b> '.CHtml::encode($data->kundennr).'&nbsp;&nbsp;<b>'.CHtml::encode($data->getAttributeLabel('anrede')).
    ':</b> '.CHtml::encode($data->anrede).'&nbsp;&nbsp;<b>'.CHtml::encode($data->getAttributeLabel('titel')).
    ':</b> '.CHtml::encode($data->titel).'&nbsp;&nbsp;<b>'.CHtml::encode($data->getAttributeLabel('vorname')).':</b> '.
    CHtml::encode($data->vorname).'&nbsp;&nbsp;<b>'.CHtml::encode($data->getAttributeLabel('name')).': </b> '.CHtml::encode($data->name),
    'buttons' => $viewButtonMenu
                //'htmlOptions' => array('class' => 'portlet-content'),
        ));
?>

    <?php
$this->widget('CTabView', array(
    'tabs'=>array(
        $data->id.'_tabPersinfo'=>array(
            'title'=>Yii::t('KontaktModule.kontakte', 'personally information'),
            'view'=>'_info',
            'data'=>array('data'=>$data),
        ),
        $data->id.'_tabPersAttachments'=>array(
            'title'=>Yii::t('KontaktModule.kontakte', 'file attachments'),
            'view'=>'_form',
            'data'=>array('data'=>$data,'model'=>$data),
        ),
        $data->id.'_tabPersGoogleMaps'=>array(
            'title'=>Yii::t('KontaktModule.kontakte', 'gMap view'),
            'view'=>'_form',
            'data'=>array('data'=>$data,'model'=>$data),
        ),
    ),
));
        $this->endWidget(); ?>
   
