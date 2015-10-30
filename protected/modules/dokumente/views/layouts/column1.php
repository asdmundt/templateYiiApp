<?php $this->beginContent('//layouts/main'); ?>

<div class="row-fluid">
  <div class="span-12"> 
       <div id="content">
            <?php 
 $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Advanced Box',
	'headerIcon' => 'icon-th-list',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'headerButtons' => array(
        array(
		'class' => 'bootstrap.widgets.TbButtonGroup',
		'type' => 'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'size'=>'small',
                'buttons' => $this->menu,
	)),
     ));           
            echo $content; 
        $this->endWidget();    
            ?>
        </div>
</div><!-- content -->
</div>

<?php $this->endContent(); ?>

