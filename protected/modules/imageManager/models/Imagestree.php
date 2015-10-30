<?php

class Imagestree extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'imagestree';
	}

	public function rules()
	{
		return array(
			array('title, position', 'required'),
			array('id_parent, position', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>25),
			array('beschr', 'safe'),
			array('id, id_parent, title, position, beschr', 'safe', 'on'=>'search'),
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
			'id_parent' => Yii::t('app', 'Id Parent'),
			'title' => Yii::t('app', 'Title'),
			'position' => Yii::t('app', 'Position'),
			'beschr' => Yii::t('app', 'Beschr'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('id_parent',$this->id_parent);

		$criteria->compare('title',$this->title,true);

		$criteria->compare('position',$this->position);

		$criteria->compare('beschr',$this->beschr,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
