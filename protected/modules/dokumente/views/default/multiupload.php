<?php

$this->widget('application.modules.dokumente.extensions.xupload.XUploadWidget', array(
					'url' => Yii::app()->createUrl("dokumente/default/upload", array("parent_id" => Yii::app()->user->name.'_'.Yii::app()->user->id)),
                    'model' => $model,
                    'attribute' => 'file',
					'multiple' => true,
));
?>
