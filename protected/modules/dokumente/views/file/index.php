<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>
<script>
        function reloadGrid() {
            $.fn.yiiGridView.update('gridfile');
            $('#select').val(' ');
            $('#bttnFileAct').hide();
        }
    </script>
            <div class="detailcontent">
                <div class="detailcontent-decoration">
                     <div id="pathvalue" class="detailcontent-left">
                         
                     </div>
                <div class="detailcontent-right">
                    
                </div>
                 
                </div>
                <div id="filegrid" class="detailcontent-content">

     
                  <?php echo $this->renderPartial('_grid', array('model'=>$model,'dataProvider' => $dataProvider,'dir'=>$dir)); ?>
                     
                </div>
                <?php
    $form = $this->beginWidget('CActiveForm', array(
        'enableAjaxValidation' => true,
            ));
    ?>
              <div id="actiongrid"  >
               <?php   echo CHtml::ajaxSubmitButton(Yii::t('DokumenteModule.file', 'new'), array('/dokumente/file/updatedialog', 'act' => 'create'), array('update' => '#dialogdiv'), array('class' => 'btn btn-primary btn-mini', 'id' => 'new' . uniqid(), 'live' => false));  ?>

        <div  id="bttnFileAct" style="display:none">
            <?php echo CHtml::ajaxSubmitButton(Yii::t('DokumenteModule.file', 'move'), array('/dokumente/file/fileact', 'act' => 'move'), array('success'=>'js: function(data) {
                        $.fn.yiiGridView.update("gridfile");
                        $("#select").val("");
                            $("#bttnFileAct").hide();}'), array('class' => 'btn btn-primary btn-mini', 'id' => 'move' . uniqid(), 'live' => false)); ?>
            
            <?php echo CHtml::ajaxSubmitButton(Yii::t('DokumenteModule.file', 'copy'), array(''), array('onclick'=>'$("#act").val("copy");$("#paste").show();'), array('class' => 'btn btn-primary btn-mini', 'id' => 'copy' . uniqid())); ?>
            
            <?php echo CHtml::ajaxSubmitButton(Yii::t('DokumenteModule.file', 'delete'), array('/dokumente/file/fileact', 'act' => 'delete'), array('success'=>'js: function(data) {
                                                 $.fn.yiiGridView.update("gridfile");$("#select").val("");$("#bttnFileAct").hide();}'), array('class' => 'btn btn-primary btn-mini', 'id' => 'delete' . uniqid(), 'live' => false)); ?>
            
            <?php echo CHtml::ajaxSubmitButton(Yii::t('DokumenteModule.file', 'upload'), array('/dokumente/file/fileact', 'act' => 'upload'), array('success'=>'js: function(data) {
                                                $.fn.yiiGridView.update("gridfile");
                        $("#select").val("");
                            $("#bttnFileAct").hide();}'), array('class' => 'btn btn-primary btn-mini', 'id' => 'upload' . uniqid(), 'live' => false)); ?>
            <?php echo CHtml::ajaxSubmitButton(Yii::t('DokumenteModule.file', 'download'), array('/dokumente/file/fileact', 'act' => 'download'), array('success'=>'js: function(data) {
                                                $.fn.yiiGridView.update("gridfile");
                        $("#select").val("");
                            $("#bttnFileAct").hide();}'), array('class' => 'btn btn-primary btn-mini', 'id' => 'download' . uniqid(), 'live' => false)); ?>    
        </div>
         <?php echo CHtml::ajaxSubmitButton(Yii::t('DokumenteModule.file', 'paste'), array('/dokumente/file/fileact', 'act' => 'paste'), array('success'=>'js: function(data) {
                                                $.fn.yiiGridView.update("gridfile");$("#select").val("");$("#bttnFileAct").hide();}'), array('class' => 'btn btn-primary btn-mini','style'=>'display:none', 'id' => 'paste')); ?>         
        <?php echo CHtml::htmlButton('<i class="icon-ban-circle"></i> Reset', array('class' => 'btn btn-primary btn-mini', 'type' => 'reset','onclick'=>'$("#documentDialog").dialog("close");','style'=>'display:none')); ?>

        <?php echo CHtml::hiddenfield('dir',$dir, array('id' => 'dir')); ?>
        <?php echo CHtml::hiddenfield('select', ' ', array('id' => 'select')); ?>
          <?php echo CHtml::hiddenfield('act', ' ', array('id' => 'act')); ?>         
    <?php echo CHtml::hiddenfield('targetDir', $model->targetDir, array('id' => 'targetDir')); ?>  
    </div>
<?php $this->endWidget(); ?>      
            </div>               
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




<?php
Yii::app()->clientScript->registerScript('createFile', "
$('#createx').bind('click', function(e){
       
	$('#contentBox_cf').show();
        $('#formaction').val('create');
	return false;
});

");

Yii::app()->clientScript->registerScript('gotoparentdir', "

$('#parentDirx').bind('click', function(){
       var parentdir = $('#dir').val();
       parentdir = parentdir + '/..';
       alert(parentdir);
        
	
	return false;
});
");

?>