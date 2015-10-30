<?php

/**
 * This is the controller class for contact operations
 *
 * @package module.kontakt.controllers.KontakteController
 * @category Contact manager
 * @author $Author$
 * @todo refactoring the Controller class
 * @version $Id$
 */
class KontakteController extends Controller {

    /**
     * @var string the name of the default action. Defaults to 'index'.
     */
    public $defaultAction = 'index';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'createDialog', 'index', 'view', 'tabview', 'dynamicCities', 'dynamicPostal'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('allow', // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function beforeRender($view) {

        $this->layout = '//layouts/column1';
        $this->menuTitle = Yii::t('KontaktModule.kontakte', 'Contacts');

        return parent::beforeRender($view);
    }

    
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     * 
     */
    public function actionView() {
        $this->render('view', array(
            'model' => $this->loadModel(),
        ));
    }

    /**
     * alte funktion für view in dialog
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed

      public function actionView() {
      if (Yii::app()->request->isAjaxRequest) {
      //outputProcessing = true because including css-files ...
      // Render view page using AJAX
      $model = $this->loadModel();
      $output = $this->renderPartial('view', array(
      'model' => $model,
      'ref_id' => $model->id,
      'asDialog' => !empty($_GET['asDialog']),
      ), true);

      echo $output;
      if (!empty($_GET['asDialog'])) {
      echo CHtml::script('window.parent.$("#kontakt-iframe").dialog("option", "height",)');
      }
      //js-code to open the dialog
      // if (!empty($_GET['asDialog'])) <span class=" parent active">Benutzer</span>
      //$menu = '<span class=" parent active">Kontakt</span><ul style="display: block;">';
      //$menu = $menu.'<li><a class="" href="/toweb/index.php?r=kontakt/kontakte/update&id='.$model->id.'">Kontakt ändern</a></li>';
      //$menu = $menu.'<li><a class="" href="/toweb/index.php?r=/dokumente/dokumente/createdialog&ref_id='.$model->id.'">Dokument erstellen/hochladen</a></li>';
      // echo CHtml::script('$("#kontakt").append("<li><a class= href=/toweb/index.php?r=kontakt/kontakte/update&id='.$model->id.'>Kontakt ändern</a></li>")');//('$("#kontakt").append("<li><a class=\"\" href="/toweb/index.php?r=kontakt/kontakte/update&id='.$model->id.'">Kontakt ändern</a></li>")');
      //echo CHtml::script('$("#kontakt").attr("style", "display: block")');//('$("#kontakt").append("<li><a class=\"\" href="/toweb/index.php?r=kontakt/kontakte/update&id='.$model->id.'">Kontakt ändern</a></li>")');

      Yii::app()->end();
      } else
      $this->render('view', array(
      'model' => $this->loadModel(),
      ));
      }
     */

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {

        $model = new Kontakte;
        $model->erfassid = Yii::app()->user->id;
        $model->erfassdatum = $this->getDateToday_german();
        $model->kundennr = 0;
        $user_id = 0;

        if (isset($_POST['Kontakte'])) {
            $model->attributes = $_POST['Kontakte'];

            if ($user_id > 0) {
                $model->kundennr = $model->getKontactNr($user_id, 1);
            } else {
                $model->kundennr = $model->getKontactNr($model->id, $model->art);
            }

            if ($model->save()) {
                echo CJSON::encode(array(
                    'status' => 'success',
                    'title' => Yii::t('KontaktModule.kontakte', 'successfully'),
                    'content' => Yii::t('KontaktModule.kontakte', '{contact} was successfully created', array($model->getDisplayName($model->vorname, $model->name)))));
            }
            //$this->redirect($this->createUrl('/kontakt/adresse/create', array('id'=>$model->id)));
        } else {
            if (Yii::app()->request->isAjaxRequest) {
                Yii::app()->clientScript->scriptMap['*.js'] = false;

                echo CJSON::encode(array(
                    'status' => 'failure',
                    'content' => $this->renderPartial('_form', array(
                        'model' => $model), true, true),
                ));

                exit();
            }
        }
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate() {
        $model = $this->loadModel();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Kontakte'])) {
            $model->attributes = $_POST['Kontakte'];
            if($model->save())
            //----- begin new code --------------------
            if (!empty($_GET['asDialog']))
            {
                //Close the dialog, reset the iframe and update the grid
                echo CHtml::script("window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$_GET['gridId']}');");
                Yii::app()->end();
            }
            else
            //----- end new code --------------------
 
            $this->redirect(array('view','id'=>$model->ADDRESS));
    }
 
    //----- begin new code --------------------
    if (!empty($_GET['asDialog']))
        $this->layout = '//layouts/iframe';
    //----- end new code --------------------
 
    $this->render('update',array(
        'model'=>$model,
    ));
            /*
            if ($model->save()) {
                if (Yii::app()->request->isAjaxRequest) {
                    // Stop jQuery from re-initialization
                    Yii::app()->clientScript->scriptMap['*.js'] = false;

                    echo CJSON::encode(array(
                        'status' => 'success',
                        'title' => Yii::t('KontaktModule.kontakte', 'successfully'),
                        'content' => $this->renderPartial('_form', array(
                            'model' => $model, 'id' => $model->id), true, true)
                    ));
                    exit;
                } else
                    $this->render('update', array('model' => $model, 'id' => $model->id));
            }
        }
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['*.js'] = false;

            echo CJSON::encode(array(
                'status' => 'failure',
                'content' => $this->renderPartial('_form', array(
                    'model' => $model), true, true),
            ));

            CApplication::end();
        }*/
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete() {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel()->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function setMenu() {
        $dataProvider = new CActiveDataProvider('Kontakte');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionList() {
        // $this->layout = '//layouts/column1';
        $dataProvider = new CActiveDataProvider('Kontakte');
        $this->render('list', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionIndex() {

        $this->layout = '//layouts/column1';

        $model = new Kontakte('search');
        $model->unsetAttributes();
        if (isset($_GET['Kontakte']))
            $model->attributes = $_GET['Kontakte'];
        $this->render('index', array(
            'model' => $model
        ));
    }

    public function actionDynamicCities() {

        $stateid = Yii::app()->request->getParam('stateid');

        $data = City::model()->findAll('state_id=:state_id', array(':state_id' => $stateid));
        $data = CHtml::listData($data, 'id', 'name');

        $dropDownCities = "";
        foreach ($data as $value => $name)
            $dropDownCities .= CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);

        Yii::app()->clientScript->scriptMap['*.js'] = false;
        // return data (JSON formatted)
        echo CJSON::encode(array(
            'dropDownCities' => $dropDownCities,
        ));
    }

    public function actionDynamicPostal() {


        $cityid = Yii::app()->request->getParam('cityid');

        $data = Zipcode::model()->findAll('city_id=:city_id', array(':city_id' => $cityid));
        $data = CHtml::listData($data, 'id', 'zipcode');

        $dropDownZipcode = "";
        foreach ($data as $value => $name)
            $dropDownZipcode .= CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);

        Yii::app()->clientScript->scriptMap['*.js'] = false;
        echo CJSON::encode(array(
            'dropDownZipcode' => $dropDownZipcode,
        ));
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'kontakte-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function rendermenu() {


        //$this->rendermenu();  

        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => $this->menuTitle,
            'htmlOptions' => array('class' => 'portlet-content'),
        ));

        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'kontakte-grid',
            'dataProvider' => new CActiveDataProvider('Kontakte'),
            'columns' => array(
                array(
                    'name' => 'name',
                    'header' => 'Name',
                    'type' => 'raw',
                    'value' => 'CHtml::link("&nbsp;&nbsp;{$data["anrede"]}&nbsp;{$data["titel"]}&nbsp;{$data["vorname"]}&nbsp;{$data["name"]}",
        "",
        array(
            \'style\'=>\'cursor: pointer; text-decoration: none;\',
            \'onclick\'=>\'{updateForm("\'.$data["id"].\'");}\'));'
                ),
            ),
        ));

        $this->endWidget();
    }

}
