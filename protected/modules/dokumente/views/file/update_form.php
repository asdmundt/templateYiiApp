<?php
$this->widget('zii.widgets.jui.CJuiTabs',array(
    'tabs'=>array(
          Yii::t('DokumenteModule.file', 'rename')=>array('id'=>'rename-id','content'=>$this->renderPartial(
                                        '_rename',
                                        array('model' => $model),TRUE
                                        )),
          Yii::t('DokumenteModule.file', 'permissions')=>array('id'=>'permissions-id','content'=>$this->renderPartial(
                                        '_permissions',
                                        array('model' => $model),TRUE
                                        )),
                  Yii::t('DokumenteModule.file', 'owners')=>array('id'=>'owners-id','content'=>$this->renderPartial(
                                        '_owners',
                                        array('model' => $model),TRUE
                                        )),
        ),
    // additional javascript options for the tabs plugin
    'options'=>array(
        'collapsible'=>FALSE,
    ),
    'id'=>'MyTab-Menu',
));
?>
    

