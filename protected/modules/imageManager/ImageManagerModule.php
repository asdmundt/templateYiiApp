<?php

class ImageManagerModule extends TwModule {

    public $mid = 3;
 
    private $_assetsUrl;

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'imageManager.models.*',
            'imageManager.components.*',
            'imageManager.controllers.*',
            'imageManager.models.*',
        ));
        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/imageManagerModule.css');
    }

    public function getAssetsUrl() {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                    Yii::getPathOfAlias('imageManager.assets'));
        return $this->_assetsUrl;
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

}
