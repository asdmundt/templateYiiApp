<?php

/**
 * EmailWebController
 *
 * @property EmailModule $module
 *
 * @author Brett O'Donnell <cornernote@gmail.com>
 * @author Zain Ul abidin <zainengineer@gmail.com>
 * @copyright 2013 Mr PHP
 * @link https://github.com/cornernote/yii-email-module
 * @license BSD-3-Clause https://raw.github.com/cornernote/yii-email-module/master/LICENSE
 *
 * @package yii-email-module
 */
class EmailWebController extends Controller
{

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();



    /**
     * @var
     */
    protected $_pageHeading;

  

    /**
     *
     */
    public function filters()
    {
        return $this->module->controllerFilters;
    }

    /**
     * @return string Defaults to the controllers pageTitle.
     */
    public function getPageHeading()
    {
        if ($this->_pageHeading === null)
            $this->_pageHeading = $this->pageTitle;
        return $this->_pageHeading;
    }

    /**
     * @param $pageHeading string
     */
    public function setPageHeading($pageHeading)
    {
        $this->_pageHeading = $pageHeading;
    }


}