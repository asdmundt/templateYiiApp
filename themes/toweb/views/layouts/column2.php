<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); 
$this->widget('ext.loading.LoadingWidget');
$this->widget('ext.slidetoggle.ESlidetoggle', array(
    'itemSelector' => '.portlet',
    'titleSelector' => '.portlet-decoration',
    'duration'=>'fast',
    'arrow' => FALSE, //comment to show the toggle arrow
));
$this->widget('ext.slidetoggle.ESlidetoggle', array(
   'duration' => 'fast',
    'arrow' => FALSE, //comment to show the toggle arrow
)); 
?>




        <div class="col-xs-6 col-md-4">

       

       <div id="sidebar">
    <?php 
                       if (!Yii::app()->user->isGuest) {
  $this->rendermenu();
                             }
    
       
        ?>  
        </div><!-- sidebar -->
    </div>

    <div class="col-xs-12 col-sm-6 col-md-8">
        <div id="content">
            <?php 
            
            echo $content; 
     
            ?>
        </div><!-- content -->
    </div>

<?php $this->endContent(); ?>

       