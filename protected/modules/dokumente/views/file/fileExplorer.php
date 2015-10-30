<?php
$this->breadcrumbs = array(
    $this->module->id,
);
?>

<?php
//<img src="/assets/1fd48b56/filetypeicons/icon_settings.gif" alt="info">
$this->menu=CMap::mergeArray(
        $this->buttonMenu,
        array(

    array('label' => Yii::t('DokumenteModule.file','Bookmark'),'icon'=>'white bookmark', // this makes it split :)
			'items' => array(
				array('label'=>Yii::t('app','my account'), 'url'=>array('/user/profile/view')),
			)),
     array('label' => Yii::t('DokumenteModule.file', 'Create dir'), 'url' => array('/dokumente/file/updatedialog','act'=>'create','dir'=>$dir),
        'htmlOptions' =>array('class' => 'openDlg') ),
    array('label' => Yii::t('DokumenteModule.file', 'Upload files'), 'url' => array('/dokumente/file/multiupload','act'=>'upload','dir'=>$dir),'htmlOptions' =>array('class' => 'uploadDlg')),
    
        ));
?>
<script>
    function reloadGridLeft() {
        $.fn.yiiGridView.update('gridfileleft');
        $('#select').val(' ');
        $('#bttnFileActleft').hide();
    }

    function reloadGridRight() {
        $.fn.yiiGridView.update('gridfileright');
        $('#select').val(' ');
        $('#bttnFileActright').hide();
    }
</script>

<div id="gridfileleftdiv" class="detailcontent-content">
   <?php echo $this->renderPartial('_grid_left', array('model' => $model, 'dataProvider' => $dataProvider, 'dir' => $dir)); ?>
</div>

<div id="gridfilerightdiv" class="detailcontent-content">
  <?php  echo $this->renderPartial('_grid_right', array('model' => $model, 'dataProvider' => $dataProvider, 'dir' => $dir));?>
</div>



<script type="text/javascript">
    
    var _dir;
    var _site;
    var _target;
    var _act;
    var _type;
    function updateDirLeft(dir,type)
    {
        Loading.show();
        
        if (typeof(dir) == 'string')
            _dir = dir;
        _target = $('#ltargetDir').val();
        _site = 'left';
        _type = type;
        var request = $.ajax({
            url: '<?php echo Yii::app()->createUrl("/dokumente/file/fileExplorer"); ?>',
            type: "GET",
            data: {path: _dir,site:_site,target:_target},
            cache: false,
            dataType: "html"
        });
        request.done(function(response) {
            try {
                //$("#footer").data("dirs", { left: 16, right: "pizza!" });
                document.getElementById('gridfileleftdiv').innerHTML = response;
                $('#ldir').val(_dir);
                $('#sldir').val(_dir);
                $('#rtargetDir').val(_dir);
                $.fn.yiiGridView.update('gridfileleft');

                return false;
            }
            catch (ex) {
                $.notify({
                    title: 'Fehler',
                    text: ex.message,
                    type: 'error',
                    opacity: .8
                   });
                

            }
            finally {
                /*Remove the loading.gif file via jquery and CSS*/
                setTimeout('Loading.hide()', 1000);
                
                /*clear the ajax object after use*/
                request = null;
            }
        });


        return false;

    }

    function updateDirRight(dir,type)
    {
        Loading.show();
 
        if (typeof(dir) == 'string')
            _dir = dir;
        _target = $('#rtargetDir').val();
        _site = 'right';
        _type = type;
        var request = $.ajax({
            url: '<?php echo Yii::app()->createUrl("/dokumente/file/fileExplorer"); ?>',
            type: "GET",
           data: {path: _dir,site:_site,target:_target},
            cache: false,
            dataType: "html"
        });

        request.done(function(response) {
            try {

                document.getElementById('gridfilerightdiv').innerHTML = response;
                $('#ltargetDir').val(_dir);
                $('#rdir').val(_dir);
                $('#srdir').val(_dir);
                $.fn.yiiGridView.update('gridfileright');

                return false;
            }
            catch (ex) {
                               $.notify({
                    title: 'Fehler',
                    text: ex.message,
                    type: 'error',
                    opacity: .8
                   });

            }
            finally {
                /*Remove the loading.gif file via jquery and CSS*/
                setTimeout('Loading.hide()', 1000);
                
                /*clear the ajax object after use*/
                request = null;
            }
        });


        return false;

    }
 
</script>
 


 

<script type="text/javascript">
 
function sendRight()
 {
 
   var data=$("#gridFormRight").serialize();
 
 
  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("/dokumente/file/fileact"); ?>',
   data:data,
success:function(data){
                    
                $.fn.yiiGridView.update('gridfileright');
                    $.fn.yiiGridView.update('gridfileleft');
              },
   error: function(data) { // if error occured
         $.notify({
                        title: 'Fehler',
                        text: data.content,
                        type: 'error',
                        opacity: .8
                    });
    },
 
  dataType:'json'
  });
 
}

function sendLeft()
 {
 
   var data=$("#gridFormLeft").serialize();
 
 
  $.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("/dokumente/file/fileact"); ?>',
   data:data,
success:function(data){
                   
                $.fn.yiiGridView.update('gridfileright');
                    $.fn.yiiGridView.update('gridfileleft');
              },
   error: function(data) { // if error occured
             $.notify({
                        title: data.title,
                        text: data.content,
                        type: 'error',
                        opacity: .8
                    });
    },
 
  dataType:'json'
  });
 
}
 
</script>
<script type="text/javascript">

    $('document').on('click','.openDlg', function(){
        
        $.ajax({
            'type': 'GET',
            'url' : $(this).attr('href'),
            success: function (data) {
                if(data.status == 'failure'){
                $('#updateDialog div.divForForm').html(data.content);
                $( '#updateDialog').dialog( 'open' );
                
                }else{
                   $( '#updateDialog').dialog( 'close' ); 
                   
                }
            },
            dataType: 'json'
        });
        
    });
    $('document').on('click','.uploadDlg', function(){
    
        
        $.ajax({
            'type': 'GET',
            'url' : $(this).attr('href'),
            success: function (data) {
               
                    $('#cru-frame').attr('src',$(this).attr('href'));
                //$('#updateDialog div.divForForm').html(data.content);
                $( '#cru-dialog').dialog( 'open' );
                
              
            },
            dataType: 'json'
        });
        return false; // prevent normal submit
    });

</script>
<?php              
Yii::app()->clientScript->registerScript('resizegrid', "
    $(document).ready(function () {
        if (document.all||document.getElementById||document.layers){
            //var h = screen.height -100;
            var h =  $(document).height()-100;
            var w = (screen.width /2)-40 ;
            $('#content').height(h  + 'px');
            $('#gridfilerightdiv').width(w  + 'px'); 
            $('#gridfileleftdiv').width(w  + 'px');
            $('#gridfilerightdiv').height(h  + 'px');
            $('#gridfileleftdiv').height(h  + 'px');

        }
        
	return false;
});

");
?> 
 
 