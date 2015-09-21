<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="de" />


        <title>
            <?php
            if (Yii::app()->params['env'] == 'dev')
                echo Yii::app()->params['version'];
            else
                echo CHtml::encode($this->pageTitle);
            ?>
        </title>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/dropdowncontent.js"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>/css/styles.css" />

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>/css/fonts.css" />

    </head>

    <body>
        <div class="container-fluid">
            <div class="row">
           
                <?php echo $content; ?>
            </div>
            <div class="clear"></div>

  
        </div><!-- page -->

    </body>
</html>
