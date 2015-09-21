<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="de" />

       

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
                    <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/dropdowncontent.js"></script>
                <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.pnotify.js"></script>
                <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.pnotify.min.js"></script>            
                 <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/jquery.pnotify.default.css" />
                <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>/css/styles.css" />
              
                <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>/css/fonts.css" />
                </head>

                <body>
                  <?php
               
                Yii::app()->bootstrap->registerAssetJs('bootstrap.js');
                Yii::app()->bootstrap->registerAssetJs('bootstrap.min.js');
                Yii::app()->bootstrap->registerJQueryCss();
                 ?>
        <div class="container-fluid" id="page">

           
                <?php echo $content; ?>

            <div class="clear"></div>

  
        </div><!-- page -->

    </body>
</html>
