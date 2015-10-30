<?php
$this->breadcrumbs = array(
    ucfirst($this->module->id)
);
$this->menu = CMap::mergeArray(
                array(
            array('label' => '&nbsp;&nbsp;<img src="' . Yii::app()->theme->getBaseUrl() . '/css/plus.png" alt="info" class="imgButton">&nbsp;&nbsp;', 'url' => array('/kontakt/kontakte/create'), 'encodeLabel' => false, 'htmlOptions' => array('class' => 'openDlg', 'title' => Yii::t('KontaktModule.kontakte', 'Create contacts'))),
            array('label' => Yii::t('KontaktModule.kontakte', 'List contacts'), 'url' => array('/kontakt/kontakte/list')),
            array('label' => Yii::t('KontaktModule.kontakte', 'Create contacts'), 'url' => array('/kontakt/kontakte/create'),
                'htmlOptions' => array('class' => 'openDlg')),
                ), $this->buttonMenu
);
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('kontakte-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php echo CHtml::link('Advanced Search', '#', array('class' => 'search-button')); ?>
<div class="search-form" style="display:none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->
<div class="gridPanel" >
    <?php
    $this->widget('zii.widgets.grid.CGridView', array(
        'id' => 'kontakte-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => array(
            'bez',
            'kundennr',
            'titel',
            'anrede',
            'vorname',
            'name',
            'strassehsnr',
            'zipcode',
            'city',
            /* 'state', */
            'tel',
            'mobil',
            /* 'fax',
              'tel2',
              'mail',
              'kontoinhaber',
              'ktnr',
              'kknr',
              'blz',
              'pan',
              'bic',
              'bankname',
              'gebdatum', */
            'art',
            /* 'erfassid',
              'erfassdatum', */
            array(
                'class' => 'CButtonColumn',
                'buttons' => array(
                    'view' =>
                    array(
                        'imageUrl' => Yii::app()->theme->getBaseUrl() . '/css/attibutes.png'),
                    'update' =>
                    array(
                        'imageUrl' => Yii::app()->theme->getBaseUrl() . '/css/pencil.png',
                        'url' => '$this->grid->controller->createUrl("update", array("id"=>$data->primaryKey,"asDialog"=>1,"gridId"=>$this->grid->id))',
                        'click' => 'function(){$("#cru-frame").attr("src",$(this).attr("href")); $("#cru-dialog").dialog("open");  return false;}',
                    ),
                    'delete' =>
                    array(
                        'imageUrl' => Yii::app()->theme->getBaseUrl() . '/css/delete.png'),
                ),
            ),
        ),
    ));
    ?>
</div>

