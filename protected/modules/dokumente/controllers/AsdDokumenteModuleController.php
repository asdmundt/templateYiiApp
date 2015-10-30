<?php

/**
 * AsdDokumenteModuleController class file.
 *
 * @author $Author$
 * @link http://46.163.72.165/toweb/
 * @version $Id: AsdDokumenteModuleController.php 1662 2012-11-03 05:23:44Z  $
 */


class AsdDokumenteModuleController extends Controller {
    
  
    
       	/**
         *
	 * get array for main menu
	 * @return array the menu items to be rendered recursively
	 */

    public function getMainmenu() {
       return array(
         array('label'=>'Start', 'url'=>array('/dokumente/default/index', 'asDialog' => 2)),  
         array('label'=>'Fileexplorer', 'url'=>array('/dokumente/file/fileexplorer', 'asDialog' => 1)),    
        array('label'=>Yii::t('DokumenteModule.file', 'File operations'), 'url'=>array('/dokumente/file/index', 'asDialog' => 2)),
        array('label'=>Yii::t('DokumenteModule.dokumente', 'Manage documents'), 'url'=>array('/dokumente/dokumente/index', 'asDialog' => 2)),
        array('label'=>Yii::t('DokumenteModule.editor', 'Texteditor'), 'url'=>array('/dokumente/editor/index', 'asDialog' => 2)),
	);
    }
}

?>
