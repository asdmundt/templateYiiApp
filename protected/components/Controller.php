<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 * @name Controller
 * @package application.components.*
 * @category Dokumenten Verwaltung
 * @author Söhnke Mundt
 * @copyright Copyright &copy; 2014 ASDMUNDT
 * @link http://www.hauscloud.de
 * @version 1.1.1 
 */
Yii::import('application.vendors.chromephp.*');
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $baseLayout = '//layouts/main';

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';

    /**
     * @var string menuTitle is the header title of the side box
     */
    public $menuTitle = 'Menu';



    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    
        /**
     * @var array tab menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $tabMenu = array(array('label' => 'Dashboard', 'url' => array('/site/index'), 'itemOptions' => array('class' => 'test')));

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $buttonMenu = array();


    
    public $_model;

    /**
     * @var int flag for display docmenu .
     */
    public $docMenu = 0;

    /**
     * @var int id primary key of model
     */
    public $ref_id = 0;

    /**
     * @var string searchstring to build sql:select from $ref_table.
     */
    public $ref_table = '';

    /**
     * @var string searchstring to build sql:select from $tree_id.
     */
    public $tree_id = '';
    public $elementid = '';

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
    
        /**
     * @var array breadcrumbs links to current page. This property will be assigned to {@link CBreadcrumbs::links}.
     */
    protected $_breadcrumbs = array();

    /**
     * @var int the status if user is logged in or not. 1 for login, 0 for logged out
     */
    public $login = 0;
    public $debug = true;

    public function init() {
        parent::init();
        date_default_timezone_set('Europe/Berlin');
        $this->menuTitle = Yii::t('app', 'Properties');
        //Yii::app()->language = 'de';
        if (!defined('YII_DEBUG'))
            $this->debug = true;
        $this->buttonMenu = array(
            array('label' => '&nbsp;<img src="' . Yii::app()->theme->getBaseUrl() . '/css/attibutes.png" alt="info">', 'url' => array('/dokumente/file/multiupload', 'act' => 'upload'), 'encodeLabel' => false),
            array('label' => '&nbsp;<img src="' . Yii::app()->theme->getBaseUrl() . '/css/archives.png" alt="info">', 'url' => array('/dokumente/file/multiupload', 'act' => 'upload'), 'encodeLabel' => false),
            array('label' => '&nbsp;<img src="' . Yii::app()->theme->getBaseUrl() . '/css/settings.png" alt="info">', 'url' => array('/dokumente/file/multiupload', 'act' => 'upload'), 'encodeLabel' => false),
        );
 
    }

    /**
     * @see		CController::filters()
     */
    public function filters() {
        return array(
            'accessControl',
        );
    }

    /*
     * get version from controllers module
     * or vers. from System
     * @return int Version
     * 
     */

    public function getVersion() {
        if (($this->getModule()) !== null)
            return $this->getModule()->version; //$this->getModule->version;
        else
            return Yii::app()->params['version'];
    }

    /**
     * @name  afterAction
     * @var $action
     * 
     */
    public function afterAction($action) {
        parent::afterAction($action);
        if (Yii::app()->params['statistik']) {
            if ('site.updatemsg' != $this->getId() . '.' . $action->id)
                Yii::log($this->getTimeStamp() . '.' . $this->getId() . '.' . $action->id . ',' . Yii::app()->user->name . ',' . $_SERVER['REMOTE_ADDR'], 'info', 'statistik');
        }
    }

    public function beforeAction($event) {
         if (Yii::app()->user->isGuest){
              
                //$this->baseLayout = Yii::app()->params['baseLayout'];
                //$this->redirect($this->createUrl('/user/login'));
               
         }
            
        return parent::beforeAction($event);
    }

    /*
     * getTimeStamp wird eingesetzt als Primary Key bei 
     * einigen Tabellen.
     * @return timestamp als unix Zeitstempel
     * date("Y-m-d H:i:s")
     */

    public function getTimeStamp() {

        return microtime(false);
    }

    public function getDateToday_german() {
        return date("d.m.Y");
    }

    public function beforeRender($view) {
        if (!parent::beforeRender($view))
            return false;
       
            $this->addBreadcrumb($this->id, array('/' . $this->action->id));

        return true;
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * 
     * @name twLog
     * write formatted log message
     * @param string $message log message
     * @param string $cat categorie of log message. default false
     */
    public function twLog($message, $cat = FALSE) {
        if ($cat) {
            ChromePhp::log($cat,'Vers ' . $this->getVersion() . '::' . Yii::app()->controller->id . '::' . Yii::app()->controller->getAction()->id . '::' . $message,ChromePhp::LOG);
            Yii::log('Vers ' . $this->getVersion() . '::' . Yii::app()->controller->id . '::' . Yii::app()->controller->getAction()->id . '::' . $message, 'info', $cat);
        } else {
            if (($this->getModule()) != null)
                $cat = $this->getModule()->id;
            //$cat = 'application.modules.' . $m . '.controllers.' . Yii::app()->controller->id;
            else
                $cat = 'application';
            
            ChromePhp::log($cat,'Vers ' . $this->getVersion() . '::' . Yii::app()->controller->id . '::' . Yii::app()->controller->getAction()->id . '::' . $message,ChromePhp::LOG);
            Yii::log('Vers ' . $this->getVersion() . '::' . Yii::app()->controller->id . '::' . Yii::app()->controller->getAction()->id . '::' . $message, 'info', $cat);
        }
    }

    public function loadModel($model = false) {
        if (!$model)
            $model = str_replace('Controller', '', get_class($this));

        if ($this->_model === null) {
            if (isset($_GET['id']))
                $this->_model = CActiveRecord::model($model)->findbyPk($_GET['id']);

            if ($this->_model === null)
                throw new CHttpException(404, Yii::t('app', 'The requested page does not exist.'));
        }
        //$this->ref_id = $this->_model->id;
        return $this->_model;
    }

    public function getDefaultContextMenuItems() {
        $items = array();

        return $items;
    }

    /*
     * render the side menu
     * einigen Tabellen.
     * @return render sidemenu as string
     */

    public function rendermenu() {
        echo "</b>";
    }
    
     /**
     * @param string $name
     * @param array|string $link
     */
    public function addBreadcrumb($name, $link = null)
    {
        if ($link)
            $this->_breadcrumbs[$name] = $link;
        else
            $this->_breadcrumbs[] = $name;
    }
    
        /**
     * @return array
     */
    public function getBreadcrumbs()
    {
        if ($this->_breadcrumbs === null)
            $this->_breadcrumbs = $this->pageTitle;
        return $this->_breadcrumbs;
    }

    /**
     * @param string $breadcrumbs
     */
    public function setBreadcrumbs($breadcrumbs)
    {
        $this->_breadcrumbs = $breadcrumbs;
    }


}