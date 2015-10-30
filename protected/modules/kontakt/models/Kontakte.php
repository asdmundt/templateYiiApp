<?php

/**
 * This is the model class for table "kontakte".
 *
 * The followings are the available columns in table 'kontakte':
 * @property string $id
 * @property string $bez
 * @property string $kundennr
 * @property string $titel
 * @property string $anrede
 * @property string $name
 * @property string $vorname
 * @property string $gebdatum
 * @property string $strassehsnr
 * @property integer $zipcode_id
 * @property integer $city_id
 * @property integer $state_id
 * @property string $land
 * @property string $tel
 * @property string $mobil
 * @property string $fax
 * @property string $tel2
 * @property string $mail
 * @property string $kontoinhaber
 * @property string $blz
 * @property integer $pan
 * @property string $bic
 * @property string $ktnr
 * @property string $bankname
 * @property string $kknr
 * @property integer $art
 * @property string $type
 * @property integer $status
 * @property string $erfassid
 * @property string $erfassdatum
 */
class Kontakte extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'kontakte';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('bez, name, erfassdatum', 'required'),
            array('zipcode_id, city_id, state_id, art, status', 'numerical', 'integerOnly' => true),
            array('bez, name, strassehsnr, land, tel, mobil, fax, tel2, mail, kontoinhaber, blz, ktnr, bankname, kknr', 'length', 'max' => 50),
            array('kundennr, bic', 'length', 'max' => 20),
            array('titel, anrede, erfassid', 'length', 'max' => 10),
            array('vorname, type', 'length', 'max' => 30),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, bez, kundennr, titel, anrede, name, vorname, gebdatum, strassehsnr, zipcode_id, city_id, state_id, land, tel, mobil, fax, tel2, mail, kontoinhaber, blz, bank, bic, pan, ktnr, bankname, kknr, art, type, status, erfassid, erfassdatum', 'safe', 'on' => 'search'),
        );
    }

    public function relations() {
        return array(
            'state' => array(self::HAS_ONE, 'State', 'id'),
            'city' => array(self::HAS_ONE, 'City', 'id'),
            'zipcode' => array(self::HAS_ONE, 'Zipcode', 'id'),
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
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'bez' => 'Bez',
            'kundennr' => 'Kundennr',
            'titel' => 'Titel',
            'anrede' => 'Anrede',
            'name' => 'Name',
            'vorname' => 'Vorname',
            'gebdatum' => 'Gebdatum',
            'strassehsnr' => 'Strassehsnr',
            'zipcode_id' => 'Postleitzahl',
            'city_id' => 'Stadt',
            'state_id' => 'Bundesland',
            'zipcode' => 'Postleitzahl',
            'city' => 'Stadt',
            'state' => 'Bundesland',
            'land' => 'Land',
            'tel' => 'Telefon',
            'mobil' => 'Mobil',
            'fax' => 'Fax',
            'tel2' => 'Telefon 2',
            'mail' => 'Mail',
            'kontoinhaber' => 'Kontoinhaber',
            'blz' => 'Blz',
            'bank' => 'Bank',
            'bic' => 'Bic',
            'pan' => 'Pan',
            'ktnr' => 'Ktnr',
            'bankname' => 'Bankname',
            'kknr' => 'Kknr',
            'art' => 'Art',
            'type' => 'Type',
            'status' => 'Status',
            'erfassid' => 'Erfassid',
            'erfassdatum' => 'Erfassdatum',
        );
    }

    public static function artAlias($code = NULL) {
        $_items = KontaktModule::module('kontakt')->artAlias;
        if (isset($code))
            return isset($_items[$code]) ? $_items[$code] : false;
        else
            return $_items;
    }

    public static function bezAlias($code = NULL) {
        $_items = array(
            '1' => Yii::t('KontaktModule.kontacts', 'Private contact'),
            '2' => Yii::t('KontaktModule.kontacts', 'Contact'),
            '3' => Yii::t('KontaktModule.kontacts', 'phoneContact'),
            '4' => Yii::t('KontaktModule.kontacts', 'Company'),
            '5' => Yii::t('KontaktModule.kontacts', 'Project'),
            '6' => Yii::t('KontaktModule.kontacts', 'Creditor'),
        );
        if (isset($code))
            return isset($_items[$code]) ? $_items[$code] : false;
        else
            return $_items;
    }

    /**
     * Returns a string.generate from a art number
     * @return string the artAlias
     */
    public function getArtAlias() {
        if (isset($this->art))
            return Kontakte::artAlias($this->art);
        else
            return Kontakte::artAlias();
    }

    /**
     * Returns a generate kontactnumber
     * @param int $id pk of kontakte row
     * @param int $art artnumber 
     * @return int the artAlias $art . $mandant . $id
     */
    public function getKontactNr($id, $art) {

        $mandant = Yii::app()->params['mandantId'];

        return $art . $mandant . $id;
    }

    /**
     * Returns a build Name
     * @param string $vn vorname
     * @param string $n name
     * @return string $vn . ' ' . $n
     */
    public function getDisplayName($vn, $n) {
        return $vn . ' ' . $n;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;


        $criteria->compare('bez', $this->bez, true);
        $criteria->compare('kundennr', $this->kundennr);
        $criteria->compare('titel', $this->titel, true);
        $criteria->compare('anrede', $this->anrede, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('vorname', $this->vorname, true);
        $criteria->compare('gebdatum', $this->gebdatum, true);
        $criteria->compare('strassehsnr', $this->strassehsnr, true);
        $criteria->compare('zipcode_id', $this->zipcode_id);
        $criteria->compare('city_id', $this->city_id);
        $criteria->compare('state_id', $this->state_id);
        $criteria->compare('land', $this->land, true);
        $criteria->compare('tel', $this->tel, true);
        $criteria->compare('mobil', $this->mobil, true);
        $criteria->compare('fax', $this->fax, true);
        $criteria->compare('tel2', $this->tel2, true);
        $criteria->compare('mail', $this->mail, true);
        $criteria->compare('kontoinhaber', $this->kontoinhaber, true);
        $criteria->compare('blz', $this->blz, true);
        $criteria->compare('bic', $this->bic, true);
        $criteria->compare('ktnr', $this->ktnr, true);
        $criteria->compare('bankname', $this->bankname, true);
        $criteria->compare('kknr', $this->kknr, true);
        $criteria->compare('art', $this->art);
        $criteria->compare('type', $this->type, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('erfassid', $this->erfassid);
        $criteria->compare('erfassdatum', $this->erfassdatum, true);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    protected function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->erfassdatum = date("Ymd");
                $this->erfassid = Yii::app()->user->id;
            }
            return true;
        } else
            return false;
    }

    protected function afterSave() {
        if (parent::afterSave()) {


            $this->kundennr = $this->getKontactNr($this->id, $this->art);
        } else
            return false;
    }

    public function getDisplayString() {
        return $this->getAttributeLabel('name') . ': ' . $this->name;
    }

    /**
     * Returns the name value from State model.
     * @return State->name value
     */
    public function getNameFromState() {
        if ($this->state_id == 0) {
            $m = State::model()->findByPk($this->state_id);
            return $m->name;
        } else {
            return " ";
        }
    }

    /**
     * Returns the name value from Zipcode model.
     * @return State->name value
     */
    public function getNameFromZipcode() {
        if ($this->zipcode_id == 0) {
            $m = Zipcode::model()->findByPk($this->zipcode_id);
            return $m->name;
        } else {
            return " ";
        }
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Kontakte the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
