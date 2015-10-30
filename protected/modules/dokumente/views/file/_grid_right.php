<?php

$this->menuRight = array(
     array('label' => Yii::t('app', 'Create dir'), 'url' => array('/dokumente/file/updatedialog','act'=>'create','dir'=>$dir),
        'htmlOptions' =>array('class' => 'uploadDlg') ),
     array('label' => Yii::t('DokumenteModule.file', 'Upload files'), 'url' => array('/dokumente/file/multiupload','act'=>'upload','dir'=>$dir),'htmlOptions' =>array('class' => 'uploadDlg','onclick'=>'$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");',)),
    array('label' => Yii::t('DokumenteModule.file','Bookmark'),'icon'=>'white bookmark', // this makes it split :)
			'items' => array(
				array('label'=>Yii::t('app','my account'), 'url'=>array('/user/profile/view')),
			)),
        );
?>

<?php
     $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => $this->menuTitle,
                //'htmlOptions' => array('class' => 'portlet-content'),
        ));
?> 
<div class="btn-toolbar" >
<?php
$this->widget('booster.widgets.TbButtonGroup', array(
    'size' => 'mini',
    'buttonType' => 'link',
     'buttons' => $this->menuRight,
));
?>

                                    </div>    
<?php $form = $this->beginWidget('booster.widgets.TbActiveForm', array(
	'id'=>'searchFormright',
	'type'=>'inline',
	'htmlOptions'=>array('class'=>'well','onsubmit'=>"return false;",),
)); ?>
<?php
	echo $form->textFieldGroup($model, 'dir',
		array('class'=>'input-large','id'=>'srdir', 'prepend'=>'<i class="icon-search"></i>'));
?>
<?php $this->widget('booster.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'Go', 'htmlOptions' => array('onclick'=>"updateDirRight($('#srdir').val(),'folder');"))); ?>
 
<?php $this->endWidget(); ?>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'enableAjaxValidation' => false,
    'id' => 'gridFormRight',
     'htmlOptions'=>array(
                               'onsubmit'=>"return false;",/* Disable normal form submit */
                               'onkeypress'=>" if(event.keyCode == 13){ sendRight(); } " /* Do ajax call when user presses enter key */
                             ),
        ));
?>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'gridfileright',
    'dataProvider' => $dataProvider,
    'selectableRows' => $dataProvider->getItemCount(),
     'selectionChanged' => "function()
            {
               var sel = $.fn.yiiGridView.getSelection('gridfileright');
               if (sel.length > 0 )
                {
                   $('#rselect').val(sel);
                
                   $('#bttnFileActright').show();
                }
                 else if (sel.length < 1)
                {
                   $('#rselect').val(' ');
                   $('#bttnFileActright').hide();
                   $('#bttnFileActoneright').hide();
                }
                else
                {
                    $('#rselect').val(' ');
                    $('#bttnFileActoneright').hide();
                    $('#bttnFileActright').hide();
                }
 
            } ",
    'columns' => array(
        array(
            'id' => 'fId',
            'class' => 'CCheckBoxColumn',
        ),
   
        array(
                'name' => 'name',
                'header' => 'Verz./Dat.',
                'type' => 'raw',
                'value' => 'CHtml::link("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$data["name"]}",
        "",
        array(
            \'style\'=>\'cursor: pointer; text-decoration: none;\',
            \'class\'=>$data["mimeType"],
            \'onclick\'=>\'{updateDirRight("\'.realpath($data["path"]).\'","\'.$data["mimeType"].\'");}\'));',
                   'visible'=>'$data["mimeType"] != "folder"',
        ),
            array(
                'name' => 'size',
                'header' => Yii::t('DokumenteModule.file', 'size'),
                //'type' => 'raw',
                'value' => 'DDirectory::getSizeFormatted($data["size"])',
            ),
            
            array(
                'name' => 'modified',
                'header' => Yii::t('DokumenteModule.file', 'modified'),
                'type' => 'raw',
                'value' => '$data["modified"]',
            ),
                    array(
                'name' => 'permissions',
                'header' => Yii::t('DokumenteModule.file', 'permissions'),
                'type' => 'raw',
                'value' => '$data["permissions"]',
            ),    
              array(
                'name' => 'uid',
                'header' => Yii::t('DokumenteModule.file', 'uid'),
                'type' => 'raw',
                'value' => '$data["uid"]',
            ),
              array(
                'name' => 'gid',
                'header' => Yii::t('DokumenteModule.file', 'gid'),
                'type' => 'raw',
                'value' => '$data["gid"]',
            ),   
          array(
                'class' => 'CButtonColumn',
                'template'=>'{open}   {info}',
                'buttons' => array(
                    'open' =>
                    array(
                    'imageUrl'=>$this->module->assetsUrl . '/filetypeicons/page_edit.gif',
                        'url' => 'Yii::app()->createUrl("/dokumente/file/updatedialog",array("path"=>$data["path"],"act"=>"open","mimeType"=>$data["mimeType"],"name"=>$data["name"],"grid_id"=>"gridfileright"))',
                        'click'=>'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
                        'options' => array(
                            'class' => 'openDlg',
                         ),
                        'visible'=>'$data["mimeType"] != "folder"',
                    ),
                                            'info' =>
                    array(
                         'imageUrl'=>$this->module->assetsUrl . '/filetypeicons/icon_settings.gif',
                        'url' => 'Yii::app()->createUrl("/dokumente/file/updatedialog",array("path"=>$data["path"],"dir"=>$data["directory"],"act"=>"update","name"=>$data["name"],"uid"=>$data["uid"],"gid"=>$data["gid"],"permissions"=>$data["permissions"]))',
                         'options' => array(
                           'class' => 'openDlg',
                        ),
                    ),
                ),
//--------------------- end added --------------------------
            ),
        ),
    ));


//----------- add the div below as container for the dialog -----------------------
?>


<div class="actiongrid"  >

    <div  id="bttnFileActright" style="display:none">
            <?php $this->widget('booster.widgets.TbButtonGroup', array(
                'size' => 'small',
    'buttons'=>array(
       array('label' => Yii::t('DokumenteModule.file', 'move'), 'url' => 'javascript:void(0)', 'htmlOptions' => array('onclick'=>"$('#ract').val('move');sendRight();")),
       array('label'=>Yii::t('DokumenteModule.file', 'copy'), 'url' => 'javascript:void(0)', 'htmlOptions' => array('onclick'=>"$('#ract').val('copy');sendRight();")),
       array('label'=>Yii::t('DokumenteModule.file', 'delete'), 'url' => 'javascript:void(0)', 'htmlOptions' => array('onclick'=>"$('#ract').val('delete');sendRight();")),
       array('label'=>Yii::t('DokumenteModule.file', 'download'), 'url' => 'javascript:void(0)', 'htmlOptions' => array('onclick'=>"$('#ract').val('download');sendRight();")),
    ),
)); ?></div>

      <?php echo $form->hiddenField($model, 'dir', array('id' => 'rdir')); ?>
         <?php echo $form->hiddenField($model, 'act', array('id' => 'ract')); ?>   
        <?php echo $form->hiddenField($model, 'select', array('id' => 'rselect')); ?>
        <?php echo $form->hiddenField($model, 'targetDir', array('id' => 'rtargetDir')); ?>

</div>
    <?php $this->endWidget(); ?>

    <?php $this->endWidget(); ?>