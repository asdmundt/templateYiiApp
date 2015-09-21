<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/column1'); 
$this->widget('ext.loading.LoadingWidget');
$this->widget('ext.slidetoggle.ESlidetoggle', array(
    'itemSelector' => '.portlet',
    'titleSelector' => '.portlet-decoration',
    //'collapsed' => '.portlet', //uncomment to show all collapsed
    'arrow' => FALSE, //comment to show the toggle arrow
)); 
?>

         <?php 
 $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => $this->menuTitle,
                //'htmlOptions' => array('class' => 'portlet-content'),
        ));
            echo $content; 
        $this->endWidget();    
            ?>

<?php $this->endContent(); ?>

