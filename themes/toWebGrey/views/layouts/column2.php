<?php /* @var $this Controller */ ?>
<?php
$this->beginContent('//layouts/main');
$this->widget('ext.loading.LoadingWidget');
$this->widget('ext.slidetoggle.ESlidetoggle', array(
    'itemSelector' => '.portlet',
    'titleSelector' => '.portlet-decoration',
    'duration' => 'fast',
    'arrow' => FALSE, //comment to show the toggle arrow
));

?>




<div class="col-xs-6 col-md-4">





    <?php
   
        echo $this->rendermenu();
        
    ?>



</div>

<div class="col-xs-12 col-sm-6 col-md-8">

<?php
$box = $this->widget(
        'booster.widgets.TbPanel', array(
    'title' => Yii::app()->name,
    'headerIcon' => 'home',
    'content' => $content,
    'headerButtons' => array(
        array(
            'class' => 'booster.widgets.TbButtonGroup',
            'context' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'buttons' => array(
                array('label' => 'Action', 'url' => array('/user/profile')) // this makes it split :)
             
            )
        ),
        array(
            'class' => 'booster.widgets.TbButtonGroup',
            'buttonType' => 'link',
            'buttons' => $this->menu,
        ),
    )
        )
);

?>

</div>

<?php $this->endContent(); ?>

