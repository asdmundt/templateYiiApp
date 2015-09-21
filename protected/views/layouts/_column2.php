<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
        <div class="span3">
        <div id="sidebar">
       <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Advanced Box',
	'headerIcon' => 'icon-th-list',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('id'=>'bootstrap-widget-sidebar')));
       $this->widget('application.modules.user.components.YumMenu', array(
                                    'items' => $this->menu,
                                    'id' => 'operationen',
                                    'htmlOptions' => array('class' => 'portlet-content'),
                                )); $this->endWidget();?>
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

