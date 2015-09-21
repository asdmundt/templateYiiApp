
<?php $this->beginContent('//layouts/main');
$this->widget('ext.loading.LoadingWidget');
$this->widget('ext.slidetoggle.ESlidetoggle', array(
    'itemSelector' => '.portlet',
    'titleSelector' => '.portlet-decoration',
   // 'collapsed' => '.portlet', uncomment to show all collapsed
    'arrow' => true, //comment to show the toggle arrow
)); 
?>


  <div class="col-xs-12 col-sm-12 col-md-12"> 
          <?php 
        
            echo $content; 
       
        ?>
</div><!-- content -->


<?php $this->endContent(); ?>
