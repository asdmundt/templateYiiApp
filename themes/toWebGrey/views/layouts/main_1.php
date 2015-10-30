<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="de" />
        <meta name="DC.title" content="Sonderangebote im November">
            <meta name="DC.identifier" content="<?php echo Yii::app()->params['version']; ?>"> 
                <?php
                Yii::app()->bootstrap->registerCoreScripts();
                Yii::app()->bootstrap->registerCoreCss();
                Yii::app()->bootstrap->registerResponsiveCss();
                //Yii::app()->bootstrap->registerYiiCss();
                ?>

                <title><?php echo CHtml::encode($this->pageTitle); ?></title>
                <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/dropdowncontent.js"></script>
                <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.pnotify.js"></script>
                <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.pnotify.min.js"></script>            



                <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->baseUrl; ?>/css/jquery.pnotify.default.css" />
                <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>/css/styles.css" />
                <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->getBaseUrl(); ?>/css/dialog.css" />
                </head>

                <body>

                    <?php
                    $this->widget('bootstrap.widgets.TbNavbar', array(
                        'type' => 'inverse',
                        'items' => array(
                            array(
                                'class' => 'bootstrap.widgets.TbMenu',
                                'items' => array(
                                    array('label' => 'Home', 'url' => array('/site/index')),
                                    array('label' => Yii::t('app', 'Contacts'), 'url' => array('/kontakt/kontakte/index'), 'visible' => (!Yii::app()->user->isGuest)),
                                    array('label' => Yii::t('app', 'Manage Users'), 'url' => array('/user/user/admin'), 'visible' => (!Yii::app()->user->isGuest) && (Yii::app()->user->isAdmin())),
                                    array('label' => Yii::t('DokumenteModule.main', 'Manage Files and Docs'), 'items' => array(
                                            array('label' => Yii::t('DokumenteModule.file', 'Fileexplorer'), 'url' => array('/dokumente/file/fileExplorer', 'link' => '/var/www')),
                                            array('label' => Yii::t('DokumenteModule.dokumente', 'Document attachments'), 'url' => array('/dokumente/dokumente/index')),
                                            array('label' => Yii::t('DokumenteModule.dokumente', 'word processing'), 'url' => array('/dokumente/dokumente/index'))),
                                        'visible' => !Yii::app()->user->isGuest),
                                    array('label' => Yii::t('app', 'Tasks'), 'url' => array('/vorgang/vorgang/index'), 'visible' => (!Yii::app()->user->isGuest)),
                                    array('label' => Yii::t('app', 'Workflow'), 'url' => array('/vorgang/workflow/index'), 'visible' => (!Yii::app()->user->isGuest) && (Yii::app()->user->isAdmin())),
                                    array('label' => 'Registrieren', 'url' => array('/user/registration/registration'), 'visible' => (Yii::app()->user->isGuest)),
                                    array('label' => 'Hilfe', 'url' => array('/site/page', 'view' => 'about')),
                                    array('label' => 'Login', 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                                    array('label' => 'Logout (' . Yii::app()->user->name . ')', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest)
                            )),
                            '',
                            array(
                                'class' => 'bootstrap.widgets.TbButtonGroup',
                                'type' => 'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                                'size' => 'small',
                                'htmlOptions' => array('class' => 'pull-right'),
                                'buttons' => array(
                                    array('icon' => 'white cog','label' => Yii::t('app', 'Settrings'), // this makes it split :)
                                        'items' => array(
                                            array('label' => Yii::t('app', 'user'), 'items' => array(
                                                    array('label' => Yii::t('app', 'List User'), 'url' => array('/user/admin/admin')),
                                                    array('label' => Yii::t('app', 'user'), 'url' => array('/site/index')),
                                                    array('label' => Yii::t('app', 'Manage Users'), 'url' => array('/auth/assignment/index')),
                                                ), 'visible' => Yii::app()->user->isAdmin()),
                                            array('label' => Yii::t('app', 'my account'), 'items' => array(
                                                    array('label' => Yii::t('app', 'profile settings'), 'url' => array('/user/profile')),
                                             
                                                ), 'visible' => !Yii::app()->user->isAdmin()),                                           
                                    )),
                                )
                            ),
                        ),
                    ));
                    $this->widget('ext.PNotify.PNotify', array(
                        'flash_messages_only' => TRUE,
                            )
                    );
                    
                     $this->widget('ext.jpupdater.JPeriodicalUpdater', array(
	'url'=>array("site/update"),
    'method'=>'post',
    'maxTimeout'=>6000,
    'callback'=>array(
        "var myHtml = 'The data returned from the server was: ' + data + ' <br />'",
        "$('#results').append(myHtml);"
    ),
)); ?>
                    <div class="container-fluid" id="page">


                        <table border="0" width="100%" cellspacing="2" cellpadding="2">
                            
   <tr>
    <td colspan="2">&nbsp;   </td>
                            </tr>                         
<tr>
    <td colspan="2">&nbsp;   </td>
                            </tr>
                            <tr>
                                <td width="50%">
<?php if (isset($this->menu)): ?>        
                                        <div class="btn-toolbar">
                                        <?php
                                        $this->widget('bootstrap.widgets.TbButtonGroup', array(
                                            'size' => 'small',
                                            'type' => '',
                                            'buttons' => $this->menu,
                                        ));
                                        ?>

                                        </div>
<?php endif ?>               
                                </td>
                                <td width="50%">
                                    <div class="btn-toolbar" style="float: right">
<?php
$this->widget('bootstrap.widgets.TbButtonGroup', array(
    'size' => 'mini',
    'type' => '',
    'buttons' => array(
                            array('label' => '<img src="' . Yii::app()->theme->getBaseUrl() . '/css/icon_info.gif" alt="info">', 'url' => array('/dokumente/file/multiupload', 'act' => 'upload'), 'encodeLabel' => false),
                            array('label' => '<img src="' . Yii::app()->theme->getBaseUrl() . '/css/icon_attachment.gif" alt="info">', 'url' => array('/dokumente/file/multiupload', 'act' => 'upload'), 'encodeLabel' => false),
                            array('label' => '<img src="' . Yii::app()->theme->getBaseUrl() . '/css/user_comment.png" alt="info">', 'url' => array('/dokumente/file/multiupload', 'act' => 'upload'), 'encodeLabel' => false),
                            array('label' => '<img src="' . Yii::app()->theme->getBaseUrl() . '/css/icon_settings.gif" alt="info">', 'url' => array('/dokumente/file/multiupload', 'act' => 'upload'), 'encodeLabel' => false),
                        )
));
?>

                                    </div>

                                </td>
                            </tr>
<tr>
                                <td colspan="2"> 
                                    <?php if (isset($this->breadcrumbs)): ?>
                            <?php
                            $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                                'links' => $this->breadcrumbs,
                            ));
                            ?><!-- breadcrumbs -->
                        <?php endif ?>

                                </td>
    </tr>
                        </table>



<?php echo $content; ?>

                        <div class="clear"></div>

                        <div id="footer">
<?php echo Yii::powered(); ?>		

                        </div><!-- footer -->

                    </div><!-- page -->
<?php
Yii::app()->clientScript->registerScript('resize', "
    $(document).ready(function () {
    element = document.documentElement;
     if(element.requestFullScreen) {
    element.requestFullScreen();
  } else if(element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if(element.webkitRequestFullScreen) {
    element.webkitRequestFullScreen();
  }
        if (document.all||document.getElementById||document.layers){
        var h =  $(document).height()-200;
         $('.bootstrap-widget-content').height(h  + 'px');
           $('#sidebar').height(h  + 'px'); 
           

}
	return false;
}

);

");
?>
                    <?php
                    $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                        'id' => 'updateDialog',
                        'options' => array(
                            'title' => '',
                            'autoOpen' => FALSE,
                            'modal' => 'true',
                            'width' => '600',
                            'height' => 'auto',
                            'cssFile' => Yii::app()->theme->getBaseUrl() . '/css/dialog.css'
                        ),
                    ));
                    ?>
                    <div class="divForForm"></div>
                    <?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

                </body>
                </html>
