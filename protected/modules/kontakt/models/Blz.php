<?php

class Blz extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'blz';
	}

	public function rules()
	{
		return array(
			array('bankleitzahl, bankbezeichnung, plz, ort, kurzbezeichnung, pan, bic', 'required'),
			array('bankleitzahl, plz, pan', 'numerical', 'integerOnly'=>true),
			array('bankbezeichnung, ort, bic', 'length', 'max'=>30),
			array('kurzbezeichnung', 'length', 'max'=>50),
			array('id, bankleitzahl, bankbezeichnung, plz, ort, kurzbezeichnung, pan, bic', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
		);
	}

	public function behaviors()
	{
		return array('CAdvancedArBehavior',
				array('class' => 'ext.CAdvancedArBehavior')
				);
	}

	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'bankleitzahl' => Yii::t('app', 'Bankleitzahl'),
			'bankbezeichnung' => Yii::t('app', 'Bankbezeichnung'),
			'plz' => Yii::t('app', 'Plz'),
			'ort' => Yii::t('app', 'Ort'),
			'kurzbezeichnung' => Yii::t('app', 'Kurzbezeichnung'),
			'pan' => Yii::t('app', 'Pan'),
			'bic' => Yii::t('app', 'Bic'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('bankleitzahl',$this->bankleitzahl);

		$criteria->compare('bankbezeichnung',$this->bankbezeichnung,true);

		$criteria->compare('plz',$this->plz);

		$criteria->compare('ort',$this->ort,true);

		$criteria->compare('kurzbezeichnung',$this->kurzbezeichnung,true);

		$criteria->compare('pan',$this->pan);

		$criteria->compare('bic',$this->bic,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
