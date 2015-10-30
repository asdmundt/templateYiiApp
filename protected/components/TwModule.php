<?php

/**
 * TwModule
 *
 * @author Soehnke Mundt <asdmundt@gmail.com>
 * @copyright 2013 asdmundt
 * @license BSD-3-Clause 
 *
 * @package application.components
 */
class TwModule extends CWebModule
{
    /**
     * @var string The ID of the CDbConnection application component. If not set, a SQLite3
     * database will be automatically created in <code>protected/runtime/email-EmailVersion.db</code>.
     */
    public $connectionID;

 

    /**
     * @var CDbConnection the DB connection instance
     */
    private $_db;

    /**
     * @var string Url to the assets
     */
    protected $_assetsUrl;

    /**
     * @var string version of the module
     */
    public $version;
     /**
     * @var int id of the module
     */
    public $mid;
    
    public $debug = true;
    
        /**
     * @var string name of the module
     */
    protected $name;
    
    public $baseDir = "";
    public $mainmenu = array();
    /**
     * @return string
     */
    public function getVersion()
    {
        return trim(file_get_contents(dirname(__FILE__) . '/../../version.txt'));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Initializes the email module.
     */
    public function init()
    {
        parent::init();
        $this->name = 'TwModule';
    }

   
    /**
     * @return CDbConnection the DB connection instance
     * @throws CException if {@link connectionID} does not point to a valid application component.
     */
    public function getDbConnection()
    {
        if ($this->_db !== null)
            return $this->_db;
        elseif (($id = $this->connectionID) !== null) {
            if (($this->_db = Yii::app()->getComponent($id)) instanceof CDbConnection)
                return $this->_db;
            else
                throw new CException(Yii::t('email', ' "{id}".connectionID "{id}" is invalid. Please make sure it refers to the ID of a CDbConnection application component.',
                    array('{id}' => $id)));
        }
        else {
            $dbFile = Yii::app()->getRuntimePath() . DIRECTORY_SEPARATOR . 'email-' . $this->getVersion() . '.db';
            return $this->_db = new CDbConnection('sqlite:' . $dbFile);
        }
    }

    /**
     * Sets the DB connection used by the cache component.
     * @param CDbConnection $value the DB connection instance
     * @since 1.1.5
     */
    public function setDbConnection($value)
    {
        $this->_db = $value;
    }

    /**
     * @return string the base URL that contains all published asset files of email.
     */
    public function getAssetsUrl()
    {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('email.assets'));
        return $this->_assetsUrl;
    }

    /**
     * @param string $value the base URL that contains all published asset files of email.
     */
    public function setAssetsUrl($value)
    {
        $this->_assetsUrl = $value;
    }
    
    	// returns the Yii User Management module. Frequently used for accessing 
	// options by calling Yum::module()->option
     /**
     * @param string $module name.
      * @return module Description
     */
	public static function module($module) {
		return Yii::app()->getModule($module);
	}


}
