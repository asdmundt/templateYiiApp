<div>
<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'kontakte-form',
   'type' => 'horizontal',
        ));
?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php echo $form->errorSummary($model); ?>
<fieldset>
    <legend><?php echo Yii::t('KontaktModule.kontakte', 'common information'); ?></legend>
    <?php echo $form->textFieldGroup($model, 'bez',array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>

    <?php echo $form->textFieldGroup($model, 'kundennr', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 20, 'disabled' => true))); ?>
</fieldset>
<fieldset>

    <legend><?php echo Yii::t('KontaktModule.kontakte', 'personally data'); ?></legend>
    <?php echo $form->textFieldGroup($model, 'titel', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-3', 'maxlength' => 10))); ?>

    <?php echo $form->textFieldGroup($model, 'anrede', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-3', 'maxlength' => 10))); ?>

    <?php echo $form->textFieldGroup($model, 'name', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>

    <?php echo $form->textFieldGroup($model, 'vorname', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>
    <?php
    echo $form->datepickerGroup(
            $model, 'gebdatum', array(
       // 'options' => array('language' => 'de'),
        'hint' => Yii::t('KontaktModule.kontakte', 'Click inside! It is open a date field.'),
        'prepend' => '<i class="icon-calendar"></i>'
            )
    );
    ?>

</fieldset>
<fieldset>

    <legend><?php echo Yii::t('KontaktModule.kontakte', 'address information'); ?></legend>
    <?php echo $form->textFieldGroup($model, 'strassehsnr', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>

    <?php
    echo $form->dropDownList($model, 'state_id', CHtml::listData(State::model()->findAll(), 'id', 'name'), array(
        'prompt' => Yii::t('app', 'Please select'),
        'ajax' => array(
            'type' => 'Get',
            'dataType' => 'json',
            'data' => array('stateid' => 'js: $(this).val()'),
            'url' => CController::createUrl('kontakte/dynamicCities'),
            'success' => "js:function(data) {
                        $('#Kontakte_city_id').removeAttr('disabled');
                        $('#Kontakte_city_id').html(data.dropDownCities);
                        }")));
    ?>

    <?php
    echo $form->dropDownList($model, 'city_id', CHtml::listData(City::model()->findAll(), 'id', 'name'), array(
        'prompt' => Yii::t('app', 'Please select'),
        'ajax' => array(
            'type' => 'Get',
            'dataType' => 'json',
            //'data'=>array( 'cityid'=>'js: $(this).val()'),
            'data' => 'js:"cityid="+jQuery(this).val()',
            'url' => CController::createUrl('kontakte/dynamicPostal'),
            'success' => "js:function(data) {
                    $('#Kontakte_zipcode_id').removeAttr('disabled');
                    $('#Kontakte_zipcode_id').html(data.dropDownZipcode);
                        }")));
    ?>

    <?php
    echo $form->dropDownList($model, 'zipcode_id', array(), array('prompt' => Yii::t('app', 'Please select')));
    ?>

    <?php echo $form->textFieldGroup($model, 'land', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>
</fieldset>
<fieldset>

    <legend><?php echo Yii::t('KontaktModule.kontakte', 'communication information'); ?></legend>
    <?php echo $form->textFieldGroup($model, 'tel', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>

    <?php echo $form->textFieldGroup($model, 'mobil', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>

    <?php echo $form->textFieldGroup($model, 'fax', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>

    <?php echo $form->textFieldGroup($model, 'tel2', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>

    <?php echo $form->textFieldGroup($model, 'mail', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>
</fieldset>
<fieldset>

    <legend><?php echo Yii::t('KontaktModule.kontakte', 'personally banking information'); ?></legend>
    <?php echo $form->textFieldGroup($model, 'kontoinhaber', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>

    <?php echo $form->textFieldGroup($model, 'ktnr', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>

    <?php echo $form->textFieldGroup($model, 'kknr', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>
</fieldset>
<fieldset>

    <legend><?php echo Yii::t('KontaktModule.kontakte', 'banking information'); ?></legend>        
    <?php echo $form->textFieldGroup($model, 'blz', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>

    <?php echo $form->textFieldGroup($model, 'pan', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>

    <?php echo $form->textFieldGroup($model, 'bic', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>



    <?php echo $form->textFieldGroup($model, 'bankname', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>

</fieldset>
<fieldset>

    <legend><?php echo Yii::t('KontaktModule.kontakte', 'description data'); ?></legend>	


    <?php echo $form->textFieldGroup($model, 'type', array('wrapperHtmlOptions' =>  array('class' => 'col-sm-5', 'maxlength' => 50))); ?>
</fieldset>
<?php echo $form->hiddenField($model, 'erfassid'); ?> 

<?php echo $form->hiddenField($model, 'erfassdatum'); ?>

<?php echo $form->hiddenField($model, 'status'); ?>
<div class="form-actions">
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'primary',
        'label' => 'Submit'
    ));
    ?>
</div>

<?php
$this->endWidget();
?>
</div>