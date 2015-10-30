<?php
$this->breadcrumbs = array(
	'Images',
	Yii::t('app', 'Index'),
);
$this->menu=CMap::mergeArray(
        $this->buttonMenu,
        array(
        array('label'=>Yii::t('app', 'Create') , 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Manage') , 'url'=>array('admin')),
)
    );




 
 ?>
<div id="update_view">
  <?php  
echo $this->renderPartial('_list', array(
	'dataProvider' => $dataProvider,
	)); ?>
</div>

<div id="xupload">
  
</div>
<script type="text/javascript">
$('document').ready(function(){
    $('.upload').live('click', function(){
        
        $.ajax({
            'type': 'GET',
            'url' : $(this).attr('href'),
            success: function (data) {
                if(data.status == 'failure'){
                $('#xupload').html(data.content);
                
                
                }else if(data.status == 'success'){
                   $('#xupload').html(data.content);
                }
            },
            dataType: 'json'
        });
        return false; // prevent normal submit
    });
    $('.openGallery').live('click', function(){
        
        $.ajax({
            'type': 'GET',
            'url' : $(this).attr('href'),
            success: function (data) {
                if(data.status == 'failure'){
                $('#update_view').html(data.content);
                
                
                }else if(data.status == 'success'){
                    $.pnotify({
                        title: data.title,
                        text: data.content,
                        type: 'success',
                        opacity: .8
                    });
                }
            },
            dataType: 'json'
        });
        return false; // prevent normal submit
    }
)});
</script>

