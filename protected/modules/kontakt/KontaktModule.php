<?php

class KontaktModule extends TwModule {

    public $mid = 2;
    public $artAlias;
    public $mainmenu;

    public function init() {
        parent::init();
        Yii::app()->clientScript->registerCssFile($this->getAssetsUrl() . '/kontaktModule.css');
        $this->name = 'KontaktModule';
    }

    public function getAssetsUrl() {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                    Yii::getPathOfAlias('kontakt.assets'));
        return $this->_assetsUrl;
    }

    public function beforeControllerAction($controller, $action) {

        if (parent::beforeControllerAction($controller, $action)) {
// this method is called before any module controller action is performed
// you may place customized code here
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
                if (isset(KontaktModule::${$key})) {
                    KontaktModule::${$key} = $value;
                } else
                    $this->$key = $value;
            }
        }
    }

}
