<?php $this->beginContent($this->baseLayout);
$this->widget('ext.loading.LoadingWidget');
$this->widget('ext.slidetoggle.ESlidetoggle', array(
    'itemSelector' => '.portlet',
    'titleSelector' => '.portlet-decoration',
    //'collapsed' => '.portlet', //uncomment to show all collapsed
    'arrow' => true, //comment to show the toggle arrow
));
?>
       <?php  $modelname = 'dokumente'; ?>
 <?php              
Yii::app()->clientScript->registerScript('resizedialog', "
    $(document).ready(function () {
        
        var modelName = '".$modelname."';
        var sh = window.parent.$('#' + modelName + '-dialog').height() - 90;
        var strsh = sh + 'px';
       
        $('#content').height(strsh); 
      
	
	return false;
});

");
?>

    

<?php echo $content; ?>
  

  
<?php $this->endContent(); ?>

