<?php
/**
 * This is the model class for File Form.
 *

 * @property string $id
 * @property string $modified
 * @property string $premission
 * @property string $uri
 * @property string $name

 * 
 * @package module.dokumente.models.Dokumente
  * @Author: Söhnke Mundt
 * @link: asdmundt@gmail.com
 * @version: 0.0.6-RC1-01-180
 */
class Images extends CActiveRecord {

    public $file;
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return 'images';
    }

    public function rules() {
        return array(
            array('name, groesse, erfassdatum', 'required'),
            array('groesse, erfassid, status, imagestree_id', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 40),
            array('endung', 'length', 'max' => 5),
            array('content, beschr', 'safe'),
            array('id, content, name, endung, groesse, erfassdatum, erfassid, status, beschr, imagestree_id', 'safe', 'on' => 'search'),
            array('file', 'file',
                'types' => 'jpg, gif, png, bmp, jpeg',
                'maxSize' => 1024 * 1024 * 100, // 10MB
                'tooLarge' => 'The file was larger than 10MB. Please upload a smaller file.',
                'allowEmpty' => true
            ),
        );
    }

    public function relations() {
        return array(
            'imagestree' => array(self::BELONGS_TO, 'Images', 'imagestree_id'),
            'images' => array(self::HAS_MANY, 'Images', 'imagestree_id'),
        );
    }

    public function behaviors() {
        return array('CAdvancedArBehavior',
            array('class' => 'ext.CAdvancedArBehavior')
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'content' => Yii::t('app', 'Content'),
            'name' => Yii::t('app', 'Name'),
            'endung' => Yii::t('app', 'Endung'),
            'groesse' => Yii::t('app', 'Groesse'),
            'erfassdatum' => Yii::t('app', 'Erfassdatum'),
            'erfassid' => Yii::t('app', 'Erfassid'),
            'status' => Yii::t('app', 'Status'),
            'beschr' => Yii::t('app', 'Beschr'),
            'imagestree_id' => Yii::t('app', 'Imagestree'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);

        $criteria->compare('content', $this->content, true);

        $criteria->compare('name', $this->name, true);

        $criteria->compare('endung', $this->endung, true);

        $criteria->compare('groesse', $this->groesse);

        $criteria->compare('erfassdatum', $this->erfassdatum, true);

        $criteria->compare('erfassid', $this->erfassid);

        $criteria->compare('status', $this->status);

        $criteria->compare('beschr', $this->beschr, true);

        $criteria->compare('imagestree_id', $this->imagestree_id);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }

    public function addImages() {
        //If we have pending images
        if (Yii::app()->user->hasState('images')) {
            $userImages = Yii::app()->user->getState('images');
            //Resolve the final path for our images
            $path = Yii::app()->getBasePath() . "/../images/uploads/{$this->id}/";
            //Create the folder and give permissions if it doesnt exists
            if (!is_dir($path)) {
                mkdir($path);
                chmod($path, 0777);
            }

            //Now lets create the corresponding models and move the files
            foreach ($userImages as $image) {
                if (is_file($image["path"])) {
                    if (rename($image["path"], $path . $image["filename"])) {
                        chmod($path . $image["filename"], 0777);
                        $img = new Image( );
                        $img->size = $image["size"];
                        $img->mime = $image["mime"];
                        $img->name = $image["name"];
                        $img->source = "/images/uploads/{$this->id}/" . $image["filename"];
                        $img->somemodel_id = $this->id;
                        if (!$img->save()) {
                            //Its always good to log something
                            Yii::log("Could not save Image:\n" . CVarDumper::dumpAsString(
                                            $img->getErrors()), CLogger::LEVEL_ERROR);
                            //this exception will rollback the transaction
                            throw new Exception('Could not save Image');
                        }
                    }
                } else {
                    //You can also throw an execption here to rollback the transaction
                    Yii::log($image["path"] . " is not a file", CLogger::LEVEL_WARNING);
                }
            }
            //Clear the user's session
            Yii::app()->user->setState('images', null);
        }
    }

}
