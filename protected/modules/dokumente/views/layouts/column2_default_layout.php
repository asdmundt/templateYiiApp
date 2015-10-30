<?php /* @var $this Controller */ ?>
<?php $this->beginContent($this->baseLayout); 
$this->widget('ext.loading.LoadingWidget');
?>
<div class="row-fluid">
        <div class="span3">
        <div id="sidebar">
       <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Advanced Box',
	'headerIcon' => 'icon-th-list',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	));
                          $this->widget('application.modules.dokumente.extensions.cfilebrowser.CFileBrowserWidget', array(
                        'script' => array('dokumente/file/filebrowser'),
                        'root' => '/var/',
                        'folderEvent' => 'click',
                        'expandSpeed' => 1000,
                        'collapseSpeed' => 1000,
                        'multiFolder' => false,
                         'outputName' => '#DDMediaAction_p1',       
                        'loadMessage' => 'File Browser Is Loading...hang on a sec',
                        'callbackFunction' => "window.parent.$('#vorgang-iframe').attr('src','" . Yii::app()->createUrl('/vorgang/vorgang/index', array('asDialog' => 2)) . " '); window.parent.$('#vorgang-dialog').dialog('open');return false;",
                    )); 
       $this->endWidget();?>
        </div><!-- sidebar -->
    </div>
    <div class="span9">
        <div id="content">
            <?php 
 $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Advanced Box',
	'headerIcon' => 'icon-th-list',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table')));           
            echo $content; 
        $this->endWidget();    
            ?>
        </div><!-- content -->
    </div>

</div>
<?php $this->endContent(); ?>
      
