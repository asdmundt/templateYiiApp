
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
	'title' => 'Advanced Box',
	'headerIcon' => 'icon-th-list',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	));
                       if (!Yii::app()->user->isGuest) {
  $this->rendermenu();
                             }
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
	'htmlOptions' => array('class'=>'bootstrap-widget-table')));           
            echo $content; 
        $this->endWidget();    
            ?>
        </div><!-- content -->
    </div>

</div>
<?php $this->endContent(); ?>

