<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'documentDialog',
                'options'=>array(
                    'title'=>Yii::t('DokumenteModule.dokumente', 'Create document'),
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>550,
                    'height'=>670,
                    'cssFile'=>Yii::app()->request->baseUrl.'/css/grayCss/dialog.css'

                ),
                ));
echo $this->renderPartial('_formDialog', array('model'=>$model)); 
$this->endWidget('zii.widgets.jui.CJuiDialog');?>