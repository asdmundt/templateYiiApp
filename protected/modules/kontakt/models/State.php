<?php

Yii::import('application.modules.kontakt.models._base.BaseState');

class State extends BaseState
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
        
        
       public function getValues(){
            return Yii::app()->db->createCommand('SELECT name from state')->queryAll();
        }
}