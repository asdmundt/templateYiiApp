<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>



<?php 
$this->tabMenu = array(array('label' => 'Dashboard', 'url' => array('/site/index'), 'itemOptions' => array('class' => 'test')));	
if(Yii::app()->user->isAdmin() || Yii::app()->params['env'] == 'dev'){
            $colArray = array('column2','column2','column3');
        }else{
           $colArray = array('column2','column2'); 
        }
    $obj = $this->widget('application.extensions.dashboard.dashboard', array(
    	'divColumns' => $colArray,
    	'dashHeader' => array('show'=>true, 'title'=>'Dashboard')
	)); 
?>


<div class="column2">      
	
	<?php 
            if(Yii::app()->user->isAdmin())
                $obj->addPortlet('system', Yii::t('app','System info'), $this->renderPartial('_info',false,true));
            else if(!Yii::app()->user->isGuest)
                $obj->addPortlet('new_incommings', Yii::t('app','New incommings'), $this->renderPartial('_incommings',false,true));
           else
               $obj->addPortlet('system', Yii::t('app','System info'), $this->renderPartial('_info',false,true));
        ?>
</div>

  
<?php $obj->end()?>