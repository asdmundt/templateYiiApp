
<div class="gridbox">
    
<div id="frmToolbar">




    </div>
  
    
    

    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'gridfile',
        'dataProvider' => $dataProvider,
        'selectableRows' => $dataProvider->getItemCount(),
        'cssFile' => Yii::app()->request->baseUrl . '/css/gridViewStyle/gridView.css',
        'selectionChanged' => "function()
            {
                var sel = $.fn.yiiGridView.getSelection('gridfile');
                
                if (sel.length > 0 )
                {
                   $('#select').val(sel);
                $('#infofile').replaceWith('<div class=\"flash-notice\">" . Yii::t('DokumenteModule.file', 'please select the target dir on treeview') . "</div>');
                   $('#bttnFileAct').show();
                }
               
                 else if (sel.length < 1)
                {
                    $('#select').val(' ');
                   
                    $('#bttnFileAct').hide();
                    $('.flash-notice').fadeOut('slow');
                } else
                {
                    $('#select').val(' ');
                   
                    $('#bttnFileAct').hide();
                    $('.flash-notice').fadeOut('slow');
                }
 
            } ",
        'columns' => array(
            array(
                'class' => 'CCheckBoxColumn',
            ),
            
            array(
                'name' => 'path',
                'header' => 'Verz./Dat.',
                'type' => 'raw',
                'value' => 'CHtml::link(
        ($data["name"]?$data["name"]:"(name)"),
        "",
        array(
            \'style\'=>\'cursor: pointer; text-decoration: none; \',
           \'class\'=>\'dirchange\',
             \'onclick\'=>\'{updateDir("\'.$data["path"].\'");}\'));'
            ),
            array(
                'name' => 'mimeType',
                'header' => Yii::t('DokumenteModule.file', 'mimeType'),
                'type' => 'raw',
                'value' => '$data["mimeType"]',
            ),
            array(
                'name' => 'size',
                'header' => Yii::t('DokumenteModule.file', 'size'),
                'type' => 'raw',
                'value' => '$data["size"]',
            ),/*
            array(
                'name' => 'modified',
                'header' => Yii::t('DokumenteModule.file', 'modified'),
                'type' => 'raw',
                'value' => 'date(THelper::$dateFormat,$data->modified)',
            ), 
             * 
             */
               array(
                'class' => 'CButtonColumn',
                'template'=>'{open}{rename}',
                'buttons' => array('view' =>
                    array(
                        'url' => 'Yii::app()->createUrl(/dokumente/file/updatedialog", array("path"=>$data["path"],"asDialog"=>1))',
                        'options' => array(
                            'ajax' => array(
                                'type' => 'POST',
                                // ajax post will use 'url' specified above 
                                'url' => "js:$(this).attr('href')",
                                'update' => '#id_view',
                            ),
                        ),
                    ),'rename' =>
                    array(
                        'url' => 'Yii::app()->createUrl("/dokumente/file/updatedialog",array("path"=>$data["path"],"act"=>"rename","name"=>$data["name"],"gridId"=>"gridfile","asDialog"=>2))',
                        'options' => array(
                            'ajax' => array(
                                'type' => 'POST',
                                // ajax post will use 'url' specified above 
                                'url' => "js:$(this).attr('href')",
                                'update' => '#dialogdiv',
                            ),
                        ),
                    ),
                ),
//--------------------- end added --------------------------
            ),
        ),
    ));

//----------- add the div below as container for the dialog -----------------------
    ?>



</div>
    
    
    