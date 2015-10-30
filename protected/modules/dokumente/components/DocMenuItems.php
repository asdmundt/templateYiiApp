<?php
/**
 * 
 *
 * @package module.dokumente.components.DocMenuItems
 * @author $Author$
 * @link http://46.163.72.165/toweb/
 * @version $Id: DocMenuItems.php 1636 2012-10-11 18:15:36Z  $
 */
Yii::import('application.modules.dokumente.models.*');
class DocMenuItems {
    
    public $ref_table;
    
    public $ref_id;
    
    public $tree_id;
    
   // public $model;


	public static function getMenuItems($ref_table,$ref_id) {
                $items = array();
                $tree=Tree::model()->find(array(
                        'condition'=>'model=:model and id_parent=1',
                        'params'=>array(':model'=>$ref_table)));
                $tree_id=$tree->id;
		$tree_cats=Tree::model()->findAll(array(
                        'condition'=>'id_parent=:id_parent',
                        'params'=>array(':id_parent'=>$tree_id)));
                $i=0;
                foreach($tree_cats as $i=>$tree_cat) {
                              $items[$i]=array('label'=>$tree_cat->title, 'url'=>array('/dokumente/dokumente/listwhereModel', 'ref_id'=>$ref_id,'ref_table'=>$ref_table,'tree_id'=>$tree_cat->id ), 'ajax' => array('update' => '#listDocs','onclick' => '$("#detailcontent").toggle(500)'));

                $i=$i+1;    
                }
                return $items;
	}
}
?>
