
<?php
/**
 * This is the controller class for Tree logic.
 *
 * @package module.dokumente.components.DocMenu
 * @author $Author$
 * @link http://46.163.72.165/toweb/
 * @version $Id: DocMenu.php 1631 2012-10-07 22:39:55Z  $
 */
Yii::import('zii.widgets.CPortlet');
Yii::import('zii.widgets.CMenu');
Yii::import('application.modules.dokumente.models.*');
class DocMenu extends CPortlet {
    
    public $ref_table;
    
    public $ref_id;
    
    public $tree_id;
    
    public $url;
    
    public $onclick;
    
    public $update;
    
   // public $model;

    
    public function init() {
		$this->title = sprintf('%s',
				
				Yum::t('Dokumente'));
  
		//$this->contentCssClass = 'portlet-content';
                $this->contentCssClass = 'label';
		return parent::init();
	}

	public function run() {
		$this->widget('application.extensions.AjaxMenu.AjaxMenu', array(
					'items' => $this->getMenuItems()
					));

		parent::run();
	}

	public function getMenuItems() {
                $items = array();
                $tree=Tree::model()->find(array(
                        'condition'=>'model=:model and id_parent=1',
                        'params'=>array(':model'=>$this->ref_table)));
                $tree_id=$tree->id;
		$tree_cats=Tree::model()->findAll(array(
                        'condition'=>'id_parent=:id_parent',
                        'params'=>array(':id_parent'=>$tree_id)));
                $i=0;
                foreach($tree_cats as $i=>$tree_cat) {
                              $items[$i]=array('label'=>$tree_cat->title, 'url'=>array($this->url, 'ref_id'=>$this->ref_id,'ref_table'=>$this->ref_table,'tree_id'=>$tree_cat->id ), 'ajax' => array('update' => $this->update,'onclick' => $this->onclick));

                $i=$i+1;    
                }
                return $items;
	}
}
?>













