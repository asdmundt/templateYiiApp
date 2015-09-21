<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="de" />

    <?php          
		Yii::app()->bootstrap->registerCoreScripts();
 		Yii::app()->bootstrap->registerCoreCss();
		Yii::app()->bootstrap->registerResponsiveCss();
		Yii::app()->bootstrap->registerYiiCss();               
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

<?php $this->widget('bootstrap.widgets.TbNavbar',array(
    'type'=>'inverse',
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url'=>array('/site/index')),
                array('label'=>Yii::t('app', 'Contacts'), 'url'=>array('/kontakt/kontakte/index'), 'visible'=>(!Yii::app()->user->isGuest)),
                array('label'=>Yii::t('app','Manage Users'), 'url'=>array('/user/user/admin'), 'visible'=>(!Yii::app()->user->isGuest) && (Yii::app()->user->isAdmin())),
                array('label'=>Yii::t('DokumenteModule.main', 'Manage Files and Docs'), 'items'=>array(
                    array('label'=>Yii::t('DokumenteModule.file','Filesystem'), 'url'=>array('/dokumente/file/fileExplorer', 'link'=>'/var/www')),
                    array('label'=>Yii::t('DokumenteModule.dokumente','Documents'), 'url'=>array('/dokumente/dokumente/index'))),
                'visible'=>!Yii::app()->user->isGuest),
                array('label'=>Yii::t('app','Tasks'), 'url'=>array('/vorgang/vorgang/index'), 'visible'=>(!Yii::app()->user->isGuest)),
                array('label'=>Yii::t('app','Workflow'), 'url'=>array('/vorgang/workflow/index'), 'visible'=>(!Yii::app()->user->isGuest) && (Yii::app()->user->isAdmin())),
                array('label'=>'Registrieren', 'url'=>array('/user/registration/registration'), 'visible'=>(Yii::app()->user->isGuest)),

                array('label'=>'Hilfe', 'url'=>array('/site/page', 'view'=>'about')),
                
          
        )),
      
        '',
        array(
		'class' => 'bootstrap.widgets.TbButtonGroup',
		'type' => 'inverse', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		'size'=>'small',
                'htmlOptions'=>array('class'=>'pull-right'),
                'buttons' => array(
			array('icon'=>'white cog', // this makes it split :)
			'items' => array(
				array('label'=>Yii::t('app','my account'), 'url'=>array('/user/profile/view'), 'visible'=>(!Yii::app()->user->isGuest)),
				
			)),
		)
	),
                array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),        
            'items'=>array(
                
                array('label'=>Yii::t('app', 'user'), 'items'=>array(
                    array('label'=>Yii::t('app','List User'), 'url'=>array('/user')),
                    array('label'=>Yii::t('app', 'user'), 'url'=>array('/site/index')),
                    array('label'=>Yii::t('app','Manage Users'), 'url'=>array('/user/admin')),
                ), 'visible'=>Yii::app()->user->isAdmin()),
                
                
                array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::app()->user->isGuest),
                array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
            ),
        ),
 
    ),
));
$this->widget('ext.PNotify.PNotify',
          array(
              'flash_messages_only' => TRUE,
          )
  ); ?>
<div class="container-fluid" id="page">

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif ?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
