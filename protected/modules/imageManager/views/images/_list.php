<?php

if($dataProvider !== null){

$this->widget('ext.widgets.EColumnListView', array(
        'columns'=>'4',
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
));
}
?>
