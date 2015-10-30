<?php

Yii::import('zii.widgets.grid.CLinkColumn');
/**
 * 
 *
 * @package module.dokumente.components.DocMenuItems
 * @author $Author$
 * @link http://46.163.72.165/toweb/
 * @version $Id$
 */
class FileExplorerColumn extends CLinkColumn {

    private $_fileClass = "dirchange";
    //public  $gridId = "";
    public function init() {
        parent::init();
        $cs=Yii::app()->getClientScript();
$gridId = $this->grid->getId();
$script = <<<SCRIPT
jQuery(".{$this->_fileClass}").live("click", function(e){
e.preventDefault();
var _dir = $(this).attr('id');
var link = this;
var container = '{$this->gridId}'+'div';
           // Call the Ajax function to update the Child CGridView //
            var request = $.ajax({ 
                url: link.href,
                data: {verz : _dir},
                type: "GET",
                cache: false,
                dataType: "html" 
            }); 
        
            request.done(function(response) { 
                try{
               
                    document.getElementById(container).innerHTML = response;
                    $('#pathvalue').text(_dir);
                    $('#dir').val(_dir);
                    $.fn.yiiGridView.update('{$this->gridId}');
                   
                    //$("#create").live("click", createfunction);
                    return false;
                }
                catch (ex){
                    log(ex.message); 
                
                }
                finally{
                /*Remove the loading.gif file via jquery and CSS*/
                setTimeout('Loading.hide()',1000);
                
                /*clear the ajax object after use*/
                request = null;
            }
            });
 
     
            return false;

        }


SCRIPT;
$cs->registerScript(__CLASS__.$gridId.'#flag_link', $script);

    }
    
    /**
	 * Renders the data cell content.
	 * This method renders a hyperlink in the data cell.
	 * @param integer $row the row number (zero-based)
	 * @param mixed $data the data associated with the row
	 */
	protected function renderDataCellContent($row,$data)
	{
	
		$options=$this->linkHtmlOptions;
		if(is_string($this->imageUrl))
			echo CHtml::link(CHtml::image($this->imageUrl,$label),$url,$options);
		else
			echo CHtml::link($label,$url,$options);
	}
}

?>
