<style type="text/css">

    table.media-dir-nav { width:0; }
    table.media-dir-nav td { padding: 1px; } 
    table.media-items td.folder img { width: 20px; height: 20px; } 
    .datahighlight { background-color: #ffdc87 !important; }
    .datahighlight2 { background-color: #ED6B2B !important; }
    div.ui-dialog form div.simple { margin: 5px 3px 5px 3px; }

</style>

<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    $this->module->id,
);
$this->menu = array(
    array('label' => 'Rename', 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => "showDialog('rename');")),
    array('label' => 'Move', 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => "showDialog('move');")),
    array('label' => 'Delete', 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => "showDialog('delete');")),
    array('label' => Yii::t('main', 'Create New Dir'), 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => "doShowDialog=true;showDialog('newdir');")),
    array('label' => Yii::t('main', 'Upload File'), 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => "doShowDialog=true;showDialog('upload');")),
);
?>




<?php
// Yii::import('DDVarDumper');
// Yii::app()->clientScript->registerCoreScript('jquery');
// DDVarDumper::dumpAsList($files); 
?>
<div id="filegrid" class="grid-view">
 <?php echo $this->renderPartial('_mediagrid', array(
            'mediaAction'=>$mediaAction, 
            'basePath'=>$basePath, 
            'path'=>$path, 
            'currentPath'=>$currentPath, 
            'files'=>$files, 
            'msg'=>$msg
        )); ?>
</div>
<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'imagePreview',
    // additional javascript options for the dialog plugin
    'options' => array(
        'title' => 'Selected Item',
        'autoOpen' => false,
        'modal' => true,
        'position' => 'center',
        'width' => 500,
    ),
));
?>
<div id="imagePlaceholder" style="width:100%"></div>
<?php $this->endWidget(); ?>

<?php $this->renderPartial('_mediaAction', array('model' => $mediaAction)); ?>
<?php Yii::app()->clientScript->registerScript('highlightRow', "$('.dirsFilesRows').hover(function(){
			$(this).children().addClass('datahighlight2');
		},function(){
			$(this).children().removeClass('datahighlight2');
		});
$('.dirsFilesRows td').click(function() {
        $(this).closest('tr').siblings().removeClass('datahighlight2').removeClass('datahighlight');
        $(this).parents('tr').toggleClass('datahighlight2', this.clicked);
    });
");
?>
<script type="text/javascript">
<!--
    var currentPath = '<?php echo $currentPath; ?>';
    var selectedItem = '.';
    var doBatchJob = false;
    var doShowDialog = false;
    var selectedItems = [];
    function toggleAll(toggle)
    {
        $('.chSelectedItems').each(function() {
            if (this.checked)
                this.checked = false;
            else
                this.checked = true;
        });
    }
    function collectChSelectedItems()
    {
        selectedItems = [];
        $('.chSelectedItems').each(function() {
            if (this.checked) {
                selectedItems.push(this.value);
            }
        });
        jQuery('#DDMediaAction_multipleNames').val(selectedItems.join("\n"));
    }
    // {{{ selectMedia
    function selectMedia(mediaType, path, name)
    {
        if (name == '..')
            doShowDialog = false;
        else
            doShowDialog = true;
        jQuery('#DDMediaAction_mediaType').val(mediaType);
        jQuery('#DDMediaAction_path').val(path);
        jQuery('#DDMediaAction_name, #DDMediaAction_oldName').val(name);
        selectedItem = name;
    } // }}} 
    // {{{ showDialog
    function showDialog(action)
    {
        if (doShowDialog == false)
            return;
        jQuery('#mydialog').dialog('open');
        if (doBatchJob == false) {
            jQuery('#mydialog').dialog({title: '<?php echo CHtml::encode(Yii::t('main', 'Item: ')); ?>' + selectedItem /* +' &rArr; '+action */});
        } else {
            jQuery('#mydialog').dialog({title: 'Multiple Selection'});
            jQuery('#batchAction').val('');
        }
        jQuery('#DDMediaAction_action').val(action);
        jQuery('#mediaActionSubmitButton').val('Submit');
        jQuery('.msg').html('').hide();
        jQuery('#selectedItemName').html(selectedItem);
        jQuery('#nameRow, #multipleNamesRow, #nameRowDisplayOnly, #p1Row, #uploadedFileRow').hide();
        switch (action)
        {
            case 'rename':
                jQuery('#mediaActionSubmitButton').val('<?php echo CHtml::encode(Yii::t('main', 'Rename')); ?>');
                jQuery('.msg').html('<?php echo CHtml::encode(Yii::t('main', 'Enter the new name:')); ?>').show();
                jQuery('#nameRowDisplayOnly, #p1Row').show();
                jQuery('label[for=DDMediaAction_p1]').html('<?php echo CHtml::encode(Yii::t('main', 'New Name')); ?>');
                jQuery('#DDMediaAction_p1').val(jQuery('#DDMediaAction_name').val());
                jQuery('#DDMediaAction_p1').focus().select();
                break;
            case 'copy':
                jQuery('#mediaActionSubmitButton').val('<?php echo CHtml::encode(Yii::t('main', 'Copy')); ?>');
                jQuery('.msg').html('<?php echo CHtml::encode(Yii::t('main', 'Enter the new destination and name:')); ?>').show();
                jQuery('#nameRowDisplayOnly, #p1Row').show();
                jQuery('label[for=DDMediaAction_p1]').html('<?php echo CHtml::encode(Yii::t('main', 'New Dest. and Name')); ?>');
                jQuery('#DDMediaAction_p1').val('./' + jQuery('#DDMediaAction_name').val());
                jQuery('#DDMediaAction_p1').focus().select();
                break;
            case 'move':
                jQuery('#mediaActionSubmitButton').val('<?php echo CHtml::encode(Yii::t('main', 'Move')); ?>');
                jQuery('.msg').html('<?php echo CHtml::encode(Yii::t('main', 'Enter the new location:')); ?>').show();
                if (doBatchJob == false) {
                    jQuery('#nameRowDisplayOnly, #p1Row').show();
                    jQuery('#DDMediaAction_p1').val('./' + selectedItem);
                } else {
                    jQuery('#multipleNamesRow, #p1Row').show();
                    jQuery('#DDMediaAction_p1').val('./');
                }
                jQuery('label[for=DDMediaAction_p1]').html('<?php echo CHtml::encode(Yii::t('main', 'Destination')); ?>');
                jQuery('#DDMediaAction_p1').focus().select();
                break;
            case 'delete':
                jQuery('#mediaActionSubmitButton').val('<?php echo CHtml::encode(Yii::t('main', 'Delete')); ?>');
                jQuery('.msg').html('<?php echo CHtml::encode(Yii::t('main', 'Confirm to delete this item:')); ?>').show();
                jQuery('#nameRowDisplayOnly').show();
                jQuery('label[for=DDMediaAction_p1]').html('<?php echo CHtml::encode(Yii::t('main', 'File to delete')); ?>');
                break;
            case 'newdir':
                jQuery('#mediaActionSubmitButton').val('<?php echo CHtml::encode(Yii::t('main', 'Create')); ?>');
                jQuery('.msg').html('<?php echo CHtml::encode(Yii::t('main', 'Enter the name for the new directory:')); ?>').show();
                jQuery('#DDMediaAction_path').val(currentPath);
                jQuery('#p1Row').show();
                jQuery('label[for=DDMediaAction_p1]').html('<?php echo CHtml::encode(Yii::t('main', 'New Directory')); ?>');
                jQuery('#DDMediaAction_p1').val('').focus().select();
                break;
            case 'upload':
                jQuery('#mediaActionSubmitButton').val('<?php echo CHtml::encode(Yii::t('main', 'Upload')); ?>');
                jQuery('.msg').html('<?php echo CHtml::encode(Yii::t('main', 'Select a file to be uploaded:')); ?>').show();
                jQuery('#DDMediaAction_path').val(currentPath);
                jQuery('#uploadedFileRow').show();
                jQuery('#DDMediaAction_uploadedFile').focus().select();
                break;
        }
        doShowDialog = false;
    } // }}} 
// -->
</script>
  <script type="text/javascript">
        var _updateDir_url;
        var _dir;
         var target;
        function updateDir(_url,dir)
        {
            //Loading.show();
            if (typeof(_url)=='string')
                _updateDir_url=_url;
            if (typeof(dir)=='string')
                _dir=dir;    
             target = $('#targetDir').val();
            var request = $.ajax({ 
                url: _updateDir_url,
                 type: "GET",
                 data: {target : target},
                cache: false,
                dataType: "html" 
            }); 
        
            request.done(function(response) { 
                try{
               
                    document.getElementById('filegrid').innerHTML = response;
                    $('#pathvalue').text(_dir);
                    $('#dir').val(_dir);
                    
                    
                    return false;
                }
                catch (ex){
                    log(ex.message); 
                
                }
                finally{
                /*Remove the loading.gif file via jquery and CSS*/
                //setTimeout('Loading.hide()',1000);
               
                /*clear the ajax object after use*/
                request = null;
            }
            });
 
     
            return false;

        }

  

</script>
