<?php

class Lesezeichen extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'lesezeichen';
	}

	public function rules()
	{
		return array(
			array('name, url', 'required'),
			array('name, host, username, pwd', 'length', 'max'=>30),
			array('url', 'length', 'max'=>50),
			array('id, name, url, host, username, pwd', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('app', 'Name'),
			'url' => Yii::t('app', 'Url'),
			'host' => Yii::t('app', 'Host'),
			'username' => Yii::t('app', 'Username'),
			'pwd' => Yii::t('app', 'Pwd'),
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);

		$criteria->compare('name',$this->name,true);

		$criteria->compare('url',$this->url,true);

		$criteria->compare('host',$this->host,true);

		$criteria->compare('username',$this->username,true);

		$criteria->compare('pwd',$this->pwd,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
