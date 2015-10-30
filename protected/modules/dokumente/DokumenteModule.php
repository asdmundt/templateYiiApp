<?php

/**
 * ********************************
 * @name DokumenteModule
 * @Author: Söhnke Mundt
 * @link: asdmundt@gmail.com
 * @version: 1.1.0-RC0-105
 * 
 * ********************************
 * 
 */
class DokumenteModule extends TwModule {

    public $mimeType = array();
    public $artAlias = array(
        '4' => 'R',
        '6' => 'R/W',
        '7' => 'R/W/X',
        '5' => 'R/X',
        '1' => 'X',
    );

    public function init() {
        parent::init();
        $this->setImport(array(
            'dokumente.models.*',
            'dokumente.components.*',
            'dokumente.controllers.*',
            'dokumente.extensions.EAjaxUpload.*',
            'dokumente.extensions.editMe.widgets.*',
        ));


        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/dokumenteModule.css');
        $this->name = 'DokumenteModule';
    }

    public function getAssetsUrl() {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                    Yii::getPathOfAlias('dokumente.assets'));
        return $this->_assetsUrl;
    }

    public function beforeControllerAction($controller, $action) {
        $controller->tabMenu = $controller->tabMenu = CMap::mergeArray($controller->tabMenu, array(array('label' => Yii::t('DokumenteModule.main', 'Manage Files and Docs'),
                        array('label' => Yii::t('DokumenteModule.file', 'Fileexplorer'), 'url' => array('/dokumente/file/fileExplorer', 'link' => '/var/www/vhosts')),
                        array('label' => Yii::t('DokumenteModule.dokumente', 'Document attachments'), 'url' => array('/dokumente/dokumente/index')),
                        array('label' => Yii::t('DokumenteModule.dokumente', 'word processing'), 'url' => array('/dokumente/dokumente/index')),
                        'visible' => !Yii::app()->user->isGuest)));
        if (parent::beforeControllerAction($controller, $action)) {

            if (Yii::app()->user->isAdmin()) {

                //exec("echo ".Yii::app()->params['sudopwd']." | sudo -S find ".$this->baseDir." -type d -exec chmod 777 {} +", $output = array());
                //exec("echo ".Yii::app()->params['sudopwd']." | sudo -S find ".$this->baseDir." -type f -exec chmod 777 {} +", $output = array()); 
            }
            return true;
        } else
            return false;
    }

    /**
     * Configures the module with the specified configuration.
     * Override base class implementation to allow static variables.
     * @param array the configuration array
     */
    public function configure($config) {
        if (is_array($config)) {
            foreach ($config as $key => $value) {
                if (isset(DokumenteModule::${$key})) {
                    DokumenteModule::${$key} = $value;
                } else
                    $this->$key = $value;
            }
        }
    }

}
