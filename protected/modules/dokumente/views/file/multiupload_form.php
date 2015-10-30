
    <div class="form">

          <?php
Yii::app()->user->setState('path', $dir);
$this->widget('xupload.XUpload', array(
					'url' => Yii::app()->createUrl("dokumente/file/upload",array("endPath" => $dir)),
                    'model' => $model,
                    
                    'attribute' => 'file',
					'multiple' => true,
));
?>


          </div>

