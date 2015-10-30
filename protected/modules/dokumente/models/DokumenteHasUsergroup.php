<?php

/**
 * This is the model class for table "dokumente_has_usergroup".
 *
 * The followings are the available columns in table 'dokumente_has_usergroup':
 * @property string $dokumente_id
 * @property string $usergroup_id
 * @property string $jointime
 */
class DokumenteHasUsergroup extends Tmodel
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return DokumenteHasUsergroup the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dokumente_has_usergroup';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dokumente_id, usergroup_id', 'required'),
			array('dokumente_id, usergroup_id', 'length', 'max'=>20),
			array('jointime', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('dokumente_id, usergroup_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    	'groups' => array(self::HAS_MANY, 'YumUsergroup', 'group_id'),
			'docs' => array(self::HAS_MANY, 'Dokumente', 'dokumente_id'),
                 
                    
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'dokumente_id' => 'Dokumente',
			'usergroup_id' => 'Usergroup',
			'jointime' => 'Jointime',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('dokumente_id',$this->dokumente_id,true);
		$criteria->compare('usergroup_id',$this->usergroup_id,true);
		$criteria->compare('jointime',$this->jointime,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}