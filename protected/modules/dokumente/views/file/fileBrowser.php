<?php
$this->breadcrumbs=array(
	'Dokumente',
);

$this->menu=array(
	array('label'=>Yii::t('DokumenteModule.dokumente', 'Create document'), 'url'=>array('create')),
        array('label'=>'meine Dateien hochladen', 'url'=>array('file/multiupload')),
	array('label'=>Yii::t('DokumenteModule.dokumente', 'Manage documents'), 'url'=>array('admin')),
);
?>



<?php
 $this->widget('application.modules.dokumente.extensions.cfilebrowser.CFileBrowserWidget',array(
                'script'=>array('filebrowser'),
                //'root'=>Yii::app()->params["uploadDir"] . 'mandant' . Yii::app()->params["mandantId"] . '/files/',
                'root' => '/var/',
                'folderEvent'=>'click',
                'expandSpeed'=>1000,
                'collapseSpeed'=>1000,
                'multiFolder'=>false,
                'loadMessage'=>'File Browser Is Loading...hang on a sec',
                'callbackFunction'=>'alert("I selected " + f)'
)); 
 

 ?>





 
