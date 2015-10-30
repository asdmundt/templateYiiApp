<?php

/**
 * This is the model class for table "dokumente".
 *
 * The followings are the available columns in table 'dokumente':
 * @property string $id
 * @property string $ref_id
 * @property string $ref_table
 * @property string $pfad
 * @property string $name
 * @property string $erfassdatum
 * @property string $erfassid
 * @property integer $STATUS
 * @property file $file
 * 
 * @package module.dokumente.models.Dokumente
 * @author Söhnke Mundt
 * @copyright Copyright &copy; 2013 ASDMUNDT
 * @link http://46.163.72.165/toweb/
 * @version 1.1 
 */
class Dokumente extends Tmodel{
        
        public $timeStamp = "";
        
        public $doc;

        /**
	 * Returns the static model of the specified AR class.
	 * @return Dokumente the static model class
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
		return 'dokumente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'length', 'max'=>40),
			array('ref_id,tree_id, ref_table,erfassid, name', 'safe'),
			array('doc', 'file', 'types'=>'doc, docx, txt, htm, html, svg, pdf'),
			// Please remove those attributes that should not be searched.
			array('id, ref_id,tree_id, ref_table, pfad, name, erfassdatum, erfassid, status', 'safe', 'on'=>'search'),
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
            'owner'=>array(self::HAS_ONE,'YumUser','erfassid'),
              'tree'=>array(self::HAS_ONE,'Tree','tree_id'),
             'userhasgroups'=>array(self::HAS_MANY,'YumGroupParticipation','user_id','through'=>'owner'),
           //'userhasgroups' => array(self::MANY_MANY, 'YumUsergroup', 'user_has_usergroup(user_id, group_id)'),
            'docgroups'=>array(self::MANY_MANY,'YumUsergroup','dokumente_has_usergroup(dokumente_id, usergroup_id)'),
           'usergroups'=>array(self::HAS_MANY,'YumUserGroup','group_id','through'=>'userhasgroups'),
  
           // 'users'=>array(self::HAS_MANY,'YumUser','user_id','through'=>'userhasgroups'),
            //'usergroup'=>array(self::HAS_ONE,'YumUserGroup','usergroup_id'),
            );
	}
        
            public function behaviors() {
                return array('CAdvancedArBehavior',
            array('class' => 'application.components.CAdvancedArBehavior')
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'ref_id' => 'Ref',
			'pfad' => 'Kategorie',
			'name' => 'Name',
			'erfassdatum' => 'Erfassdatum',
			'erfassid' => 'Erfassid',
			'status' => 'Sichtbar',
		);
	}	
        
        
        public static function itemAlias($type, $code=NULL) {
		$_items = array(
			'UserStatus' => array(
				'0' => Yum::t('Not active'),
				'1' => Yum::t('Activated, not yet logged in once'),
				'2' => Yum::t('Active - first visit'),
				'3' => Yum::t('Active'),
				'-1' => Yum::t('Banned'),
				'-2' => Yum::t('Deleted'),
			),
			'AdminStatus' => array(
				'0' => Yum::t('No'),
				'1' => Yum::t('Yes'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('ref_id',$this->ref_id,true);
		$criteria->compare('pfad',$this->pfad,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('erfassdatum',$this->erfassdatum,true);
		$criteria->compare('erfassid',$this->erfassid,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
        
        public function getpk(){
            //SELECT MAX( id ) AS id FROM dokumente 
            $id=Yii::app()->db->createCommand('SELECT MAX( id ) AS id FROM dokumente')->queryScalar();
            Yii::log('Dokumente:getpk:$id= ' . $id, 'info', 'application');
            $pk = $id + 1;
            Yii::log('Dokumente:getpk:$pk= ' . $pk, 'info', 'application');
            return $pk;
        }
        
       public function getDisplayString() {
        return $this->getAttributeLabel('name').': '.$this->name;
    }
    
     /**
    * Saves the name, size, type and data of the uploaded file
    */
    public function beforeSave()
    {
        if($file=CUploadedFile::getInstance($this,'uploadedFile'))
        {
            $this->file_name=$file->name;
            $this->file_type=$file->type;
            $this->file_size=$file->size;
            $this->file_content=file_get_contents($file->tempName);
        }
 
    return parent::beforeSave();
    }
}