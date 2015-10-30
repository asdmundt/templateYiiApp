<?php

Yii::import('application.modules.kontakt.models._base.BaseZipcode');

class Zipcode extends BaseZipcode {

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function zipcodeAutoComplete($name = '') {

        // Recommended: Secure Way to Write SQL in Yii 
        $sql = 'SELECT id ,zipcode AS label FROM zipcode WHERE zipcode LIKE :name';
        $name = $name . '%';
        return Yii::app()->db->createCommand($sql)->queryAll(true, array(':name' => $name));

    }

}