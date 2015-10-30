<?php
/**
 * This is the model class for table "tree".
 *
 * @package module.dokumente.models.Tree
 * @author Söhnke Mundt
 * @copyright Copyright &copy; 2012 ASDMUNDT
 * @license BSD 3-clause
 * @link http://46.163.72.165/toweb/
 * @version 1.1 
 * 
 *
 * The followings are the available columns in table 'tree':
 * @property integer $id
 * @property integer $id_parent
 * @property string $title
 * @property integer $position
 * @property string $url
 * @property string $icon
 * @property string $model
 */
class Tree extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Tree the static model class
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
		return 'tree';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, position, url, model', 'required'),
			array('id_parent, position', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>25),
			array('url', 'length', 'max'=>255),
			array('icon, model', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, id_parent, title, position, url, icon, model', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app', 'ID'),
			'id_parent' => Yii::t('app', 'Id Parent'),
			'title' => Yii::t('app', 'Title'),
			'position' => Yii::t('app', 'Position'),
			'url' => Yii::t('app', 'Url'),
			'icon' => Yii::t('app', 'Icon'),
			'model' => Yii::t('app', 'Model'),

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

		$criteria->compare('id',$this->id);
		$criteria->compare('id_parent',$this->id_parent);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('icon',$this->icon,true);
		$criteria->compare('model',$this->model,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}