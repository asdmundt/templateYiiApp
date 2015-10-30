<?php

/**
 * CEditableGridView represents a grid view which contains editable rows
 * and an optional 'Quickbar' which fires an action that quickly adds
 * entries to the table.
 *
 * To make a Column editable you have to assign it to the class 'CEditableColumn'
 *
 * Use it like the CGridView:
 *
 * $this->widget('zii.widgets.grid.CEditableGridView', array(
 *     'dataProvider'=>$dataProvider,
 *     'showQuickBar'=>'true',
 *     'quickCreateAction'=>'QuickCreate', // will be actionQuickCreate()
 *     'columns'=>array(
 *           'title',          // display the 'title' attribute
 *            array('header' => 'editMe', 'name' => 'editable_row', 'class' => 'CEditableColumn')
 *     ));
 *
 * With this Config, the column "editable_row" gets rendered with
 * inputfields. The Table-header will be called "editMe".
 *
 * You have to define a action that receives $_POST data like this:
 *   public function actionQuickCreate() {
 *	   $model=new Model;
 *      if(isset($_POST['Model']))
 *       {
 * 	      $model->attributes=$_POST['Model'];
 * 	      if($model->save())
 * 	      $this->redirect(array('admin')); //<-- assuming the Grid was used unter view admin/
 *       }
 *     }
 *
 * @author Herbert Maschke <thyseus@gmail.com> at version 1.2 @author Söhnke Mundt
 * @package zii.widgets.grid
 * @since 1.2
 */

Yii::import('zii.widgets.grid.CGridView');
Yii::import('ext.cEditableGridView.CEditableColumn');
Yii::import('ext.cEditableGridView.Relation');

class CEditableGridView extends CGridView {
	public $showQuickBar=true;
        public $showButtonBar=true;
	public $quickCreateAction='QuickCreate';
	public $quickUpdateAction='QuickUpdate';
        public $createAction='create';
	public $addButtonValue='ok';
        public $addButtonClass='+';
	public function renderQuickBar() {
		printf ('<form method="post" action="%s">',$this->quickCreateAction);
				echo "<tr>";
		foreach($this->columns as $column) 
		{
			if(!$column instanceof CButtonColumn) 
			{
					if($column instanceof CCheckBoxColumn) 
						printf('<td><input name="%s[%s]" type="checkbox" /></td>', $this->dataProvider->modelClass, $column->name);
					else if($column instanceof CDataColumn 
						|| $column instanceof CEditableColumn) 
					{
						if(strstr($column->name, '.') != FALSE) // Column contains an relation
						{
							$data = explode('.', $column->name);
							$this->widget('Relation', array('model' => $this->dataProvider->modelClass, 'relation' => $data[0] , 'fields' => $data[1])); 
						} else {
						printf('<td><input name="%s[%s]" type=text style="width:100%%;" /></td>', $this->dataProvider->modelClass, $column->name);
					  }	
					}
					else if($column instanceof CLinkColumn) 
						printf('<td></td>');
					else
						printf('<td></td>');
				}
			}
			printf('<td><input class="" type=submit value="%s"></td>', $this->addButtonValue);
		echo "</tr>";
		echo "</form>";

	}
        
       
        /**
	 * Renders a table body row.
	 * @param integer $row the row number (zero-based).
	 */
	public function renderTableRow($row)
	{
            $data=$this->dataProvider->data[$row];
                    printf ('<form id="%s-%s-form" method="post" action="%s">',$this->id,$row,$this->quickUpdateAction);            
            if($this->rowCssClassExpression!==null)
		{
			
			echo '<tr class="'.$this->evaluateExpression($this->rowCssClassExpression,array('row'=>$row,'data'=>$data)).'">';
		}
		else if(is_array($this->rowCssClass) && ($n=count($this->rowCssClass))>0)
			echo '<tr class="'.$this->rowCssClass[$row%$n].'">';
		else
                    echo '<tr>';
		foreach($this->columns as $column)
			$column->renderDataCell($row);
                echo "<td>";
                printf('<input style="width:100%%" name="%s[%s]" type="hidden" value="%s" />', $this->dataProvider->modelClass, 'id', $data->id);
		printf('<input class="" type=submit value="%s">', $this->addButtonValue);
                
                echo "</td>";
                echo "</tr>";
                echo "</form>";
               
	}

	public function renderTableBody() {
		parent::renderTableBody();
                if($this->showQuickBar)
                    $this->renderQuickBar();
                
                
	}
        
    
}
