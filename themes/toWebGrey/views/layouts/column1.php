
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
        $box = $this->widget(
    'booster.widgets.TbPanel',
    array(
        'title' => Yii::t('app', 'List'),
        'headerIcon' => 'list-alt',
        'htmlOptions'=> array('id' => 'mainPanel'),
        'content' => $content,
        'headerButtons' => array(
            array(
                'class' => 'booster.widgets.TbButtonGroup',
                
                'buttons' => array(
                    array('label' => 'Action', 'url' => '#'), // this makes it split :)
                    
                )
            ),
            array(
                'class' => 'booster.widgets.TbButtonGroup',
                'buttonType' => 'link',
                'buttons' => $this->menu,
                
            ),
            array(
                'class' => 'booster.widgets.TbButtonGroup',
                'context' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'buttonType' => 'link',
                'buttons' => array(
                    array('label' => Yii::t('app', 'List'), 'url' => array('index'))
                ),
                
            ),
        )
    )
);
            //echo $content; 
      
        ?>
</div>


<?php $this->endContent(); ?>
