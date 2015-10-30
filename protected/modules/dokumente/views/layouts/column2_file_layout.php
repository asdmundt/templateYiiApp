 <?php /* @var $this Controller */ ?>
<?php $this->beginContent($this->baseLayout); 
$this->widget('ext.loading.LoadingWidget');
$this->widget('ext.slidetoggle.ESlidetoggle', array(
    'itemSelector' => '.portlet',
    'titleSelector' => '.portlet-decoration',
    //'collapsed' => '.portlet', //uncomment to show all collapsed
    'arrow' => FALSE, //comment to show the toggle arrow
)); 
?>
<div class="row-fluid">
        <div class="span3">
        <div id="sidebar">
 <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => $this->menuTitle,
	'headerIcon' => 'icon-th-list',
 	
'htmlOptions' => array('class'=>'bootstrap-widget-table')));
  $this->beginWidget('zii.widgets.CPortlet', array(
                        'title' => '/   ',
                    ));
                          $this->widget('application.modules.dokumente.extensions.cfilebrowser.CFileBrowserWidget', array(
                        'script' => array('dokumente/file/filebrowser'),
                        //'root' => Yii::app()->params["uploadDir"] . 'mandant' . Yii::app()->params["mandantId"] . '/files/',
                        'root' => '/',
                        'folderEvent' => 'click',
                        'expandSpeed' => 1000,
                        'collapseSpeed' => 1000,
                        'multiFolder' => false, 
                        'loadMessage' => 'File Browser Is Loading...hang on a sec',
                        'folderCallback' => true,
                             
                        'callbackFunction'=>'updateDir(f);'      
                        
                    ));
       $this->endWidget();                   
       $this->endWidget();
       ?>
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
	'headerButtons' => array(
        array(
		'class' => 'bootstrap.widgets.TbButtonGroup',
		'type' => 'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'size'=>'small',
                'buttons' => $this->menu,
	)),
     ));           
            echo $content; 
        $this->endWidget();    
            ?>
        </div><!-- content -->
    </div>

</div>
<?php $this->endContent(); ?>

 <script type="text/javascript">
        var _updateDir_url;
        var _dir;
         var target;
        function updateDir(dir)
        {
            //Loading.show();
            if (typeof(_url)=='string')
                _updateDir_url=_url;
            if (typeof(dir)=='string')
                _dir=dir;    
             target = $('#targetDir').val();
            var request = $.ajax({ 
                url: '<?php echo Yii::app()->createUrl("/dokumente/file/index");?>',
                 type: "GET",
                 data: {path : _dir},
                cache: false,
                dataType: "html" 
            }); 
        
            request.done(function(response) { 
                try{
               
                    document.getElementById('filegrid').innerHTML = response;
                    $('#pathvalue').text(_dir);
                    $('#dir').val(_dir);
                    
                    $.fn.yiiGridView.update('gridfile');
                   
                    $("#create").live("click", createfunction);
                    return false;
                }
                catch (ex){
                    log(ex.message); 
                
                }
                finally{
                /*Remove the loading.gif file via jquery and CSS*/
                setTimeout('Loading.hide()',1000);
                $('#contentBox_cf').hide();
                /*clear the ajax object after use*/
                request = null;
            }
            });
 
     
            return false;

        }

  

function createfunction() {
        
	
        $('#formaction').val('create');
	return false;
}

$('#create').bind('click', function(e){
        
	$('#contentBox_cf').show();
        $('#formaction').val('create');
	return false;
});
</script>

