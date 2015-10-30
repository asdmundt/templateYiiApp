	
<?php                                 $this->beginWidget('zii.widgets.CPortlet', array(
                                    'title' => $this->menuTitle,
                                    'htmlOptions' => array('class' => 'portlet-content'),
                                ));
                                
                   $this->widget(
            'CTreeView', array('url' => array('/dokumente/dokumente/ajaxFillTree'),
            'animated' => 'fast', 'collapsed' => true,));
                            
$this->endWidget();  
                  $this->widget(
            'CTreeView', array('url' => array('/dokumente/dokumente/ajaxFillTree'),
            'animated' => 'fast', 'collapsed' => true,));
                           
       $this->endWidget(); ?>
	

