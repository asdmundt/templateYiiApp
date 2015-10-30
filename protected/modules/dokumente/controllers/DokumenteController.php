<?php

/**
 * This is the controller class for dokumente logic.
 *
 * @package module.dokumente.controllers.DokumenteController
 * @category Dokumenten Verwaltung
 * @author $Author$
 * @link http://46.163.72.165/toweb/
 * @version $Id: DokumenteController.php 1632 2012-10-07 22:44:13Z  $
 */
class DokumenteController extends AsdDokumenteModuleController {

    
     /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column2';
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
     * 

     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update', 'index', 'view', 'privacySettings', 'upload', 'createDialog', 'ajaxFillTree', 'listwhereModel'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'expression' => 'Yii::app()->user->getState("art") < 2',
            ),
            array('deny', // deny all other users
                'users' => array('*'),
            ),
        );
    }

 

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView() {
        $this->render('view', array(
            'model' => $this->loadModel(),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Dokumente;
        $model->erfassid = Yii::app()->user->id;
        $model->erfassdatum = $this->getDateToday_german();
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Dokumente'])) {
            $model->attributes = $_POST['Dokumente'];

            if ($model->save())
                $this->redirect($this->createUrl('update', array('id' => $model->id)));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreatedialog() {
        $model = new Dokumente;
        Yii::log('DokumenteController:actionCreate:$model->tree_id= ', 'info', 'application');
        $this->performAjaxValidation($model);
        if (isset($_GET['ref_id']) && isset($_GET['ref_table'])) {
            $model->ref_id = $_GET['ref_id'];
            $model->tree_id = $_GET['tree_id'];
            $model->ref_table = $_GET['ref_table'];
            $model->erfassid = Yii::app()->user->id;
            $model->erfassdatum = $this->getDateToday_german();
            Yii::log('DokumenteController:actionCreate:$model->tree_id= ' . $model->tree_id, 'info', 'application');
        }
        // Uncomment the following line if AJAX validation is needed
        //$this->performAjaxValidation($model);

        if (isset($_POST['Dokumente'])) {
            $model->attributes = $_POST['Dokumente'];

            if ($model->save()) {
                echo CJSON::encode(array(
                    'pfad' => $model->tree_id,
                    'id' => $model->id,
                ));
                Yii::app()->end();
            }
        } else {
            if (Yii::app()->request->isAjaxRequest) {
                // Stop jQuery from re-initialization
                Yii::app()->clientScript->scriptMap['jquery.js'] = false;

                echo CJSON::encode(array(
                    'status' => 'failure',
                    'content' => $this->renderPartial('createdialog', array(
                        'model' => $model)),
                ));
                CApplication::end();
            }
            else
                $this->render('create', array('model' => $model));

            $this->renderPartial('createdialog', array(
                'model' => $model,
                    ), false, true);
        }
    }

    public function actionAjaxFillTree() {

        if (!Yii::app()->request->isAjaxRequest) {
            CApplication::end();
        }
        $parentId = "1";
        if (isset($_GET['root']) && $_GET['root'] !== 'source') {
            $parentId = (int) $_GET['root'];
        }

        $sql = "SELECT m1.id, m1.title AS text, m2.id IS NOT NULL AS hasChildren,m1.url "
                . "FROM tree AS m1 LEFT JOIN tree AS m2 ON m1.id=m2.id_parent "
                . "WHERE m1.id_parent <=> $parentId and m1.model = 'dokumente'"
                . "GROUP BY m1.id ORDER BY m1.position ASC";
        $req = Yii::app()->db->createCommand($sql);
        $children = $req->queryAll();

        $children = $this->createLinks($children);

        echo str_replace(
                        '"hasChildren":"0"',
                        '"hasChildren":false',
                       CTreeView::saveDataAsJson($children)
                        //CTreeView::saveDataAsHtml($children)
                );
        exit();
    }

    private function createLinks($children) {
        $child = array();
        $return = array();
        foreach ($children AS $key => $value) {
            $child['id'] = $value['id'];
            $child['text'] = $value['text'];
            $child['hasChildren'] = $value['hasChildren'];
            Yii::log('$value["hasChildren"]= ' . $value['hasChildren'], 'info', 'application');
            if (strlen($value['url']) > 0) {
                $child['text'] = $this->format($value['id'], $value['text'], $value['url'], Yii::app()->request->url);
            }

            $return[] = $child;
            $child = array();
        }

        return $return;
    }

    private function format($id, $text, $url, $icon = NULL) {
        $img = '';
        $imgAdd = '<img src="' . $this->module->assetsUrl  . '/filetypeicons/icon_attachment.gif">';
        if (isset($icon))
            $img = '<img src="' . $this->module->assetsUrl  . '/filetypeicons/' . $icon . '">';

        return sprintf('<span>&nbsp;%s&nbsp;&nbsp;</span>', CHtml::link(($imgAdd . ' ' . $text), Yii::app()->createUrl($url, array('tree_id' => $id))));
        /*
          CHtml::ajaxlink('Dokument anlegen',Yii::app()->createUrl('/dokumente/dokumente/createdialog',array('ref_id'=>$this->ref_id, 'ref_table'=>$this->ref_table)),array(
          'onclick'=>'$("#documentDialog").dialog("open"); return false;',
          'update'=>'#document'
          ));
         */
    }

    public function actionUpload($ref_id, $ref_table, $id) {
        $this->m->erfassid;
        Yii::log('DokumenteController:actionUpload:$id= ' . $id, 'info', 'application');
        Yii::log('DokumenteController:actionUpload:$this->m->erfassid= ' . $this->m->erfassid, 'info', 'application');
        //Yii::import("dokumente.extensions.EAjaxUpload.qqFileUploader");
        $folder = Yii::app()->params['uploadDir'] . "mandant" . Yii::app()->params['mandantId'] . "/" . $ref_table . "/" . $ref_id . "/" . $id . "/"; // folder for uploaded files
        Yii::log('DokumenteController:actionUpload:$folder= ' . $folder, 'info', 'application');

        $allowedExtensions = array("svg", "txt", "doc", "docx", "odt", "rtf", "xml", "xls", "jpg", "jpeg", "gif", "doc", "pdf", "ini", "html", "php", "cfg", "conf", "htm"); //array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 100 * 1024 * 1024; // maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        if (!Yii::app()->file->set($folder, true)->exists) {
            Yii::log('!Yii::app()->file->set($folder, true)->exists', 'info', 'application');
            if (Yii::app()->file->createDir(0775, $folder)) {
                $result = $uploader->handleUpload($folder);
                $result = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                Yii::log('DokumenteController:actionUpload= Verzeichnisse angelegt', 'info', 'application');
            } else {
                $result = array('error' => 'Verzeichnisse ' . $folder . ' konnte nicht angelegt werden');
            }
        } else {
            $result = $uploader->handleUpload($folder);
            $result = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        }
        Yii::log('DokumenteController:actionUpload:$result= ' . $result, 'info', 'application');
        echo $result;


        /*
          echo CHtml::ajaxlink('Dokument anlegen',$this->createUrl('/dokumente/dokumente/upload',array('ref_id'=>$ref_id, 'ref_table'=>$ref_table)),array(
          'onclick'=>'$("#documentDialog").dialog("open"); return false;',
          'update'=>'#documentDialog'
          ),array('id'=>'showdocumentDialog'));
         */
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     * 
     */
    public function actionUpdate() {
        $model = $this->loadModel();

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Dokumente'])) {
            $model->attributes = $_POST['Dokumente'];
            $model->docgroups = Relation::retrieveValues($_POST);
            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id the ID of the model to be deleted
     * 
     */
    public function actionDelete() {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel()->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {

        $activeDataProvider = new CActiveDataProvider('Dokumente');

        $params = array(
            'activeDataProvider' => $activeDataProvider,
        );
        //$this->menu = $this->setSideMenu();
        if (!isset($_GET['ajax']))
            $this->render('index', $params);
        else
            $this->renderPartial('index', $params);
    }

    /**
     * List Models.
     * @param  $_GET['ref_id']= model->id
     * @param  $_GET['ref_table']= model->tableName() 
     * @todo Fix Tree Menu
     */
    public function actionListwhereModel() {

        if (isset($_GET['ref_id']) && isset($_GET['ref_table'])) {
            $this->ref_id = $_GET['ref_id'];
            $this->ref_table = $_GET['ref_table'];

            if (isset($_GET['tree_id']))
                $this->tree_id = $_GET['tree_id'];
            else
                $this->tree_id = 0;
            $sql = "ref_id = " . $this->ref_id . " and ref_table = '" . $this->ref_table . "' and tree_id = " . $this->tree_id;
            Yii::log('DokumenteController:actionListwhereModel= sql ' . $sql, 'info', 'application');
            $criteria = new CDbCriteria;
            $criteria->select = array('*');
            if ($tree_id > 0)
                $criteria->condition = "ref_id = " . $ref_id . " and ref_table = '" . $ref_table . "' and tree_id = " . $tree_id;
            else
                $criteria->condition = "ref_id = " . $ref_id . " and ref_table = '" . $ref_table . "'";
            $activeDataProvider = new CActiveDataProvider('Dokumente', array(
                'criteria' => $criteria,
                    ));

            $activeDataProvider->getData();
            // if (!isset($_GET['ajax']))
            //      $this->render('listwhereModel',array('activeDataProvider' => $activeDataProvider,) );
            //  else
            $this->renderPartial('listwhereModel', array('activeDataProvider' => $activeDataProvider,));
        }
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Dokumente('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Dokumente']))
            $model->attributes = $_GET['Dokumente'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'dokumente-dialog') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionDialogPrivacySettings() {
        $model = $this->m;
        Yii::log('DokumenteController:actionDialogPrivacySettings= status' . $model->erfassid, 'info', 'application');
        $usersGroups = YumUsergroup::model()->findAll(
        );
        if (isset($_POST['Dokumente'])) {
            $model->attributes = $_GET['Dokumente'];
            Yii::log('DokumenteController:actionDialogPrivacySettings= status' . $model->status, 'info', 'application');
        }
        // $this->performAjaxValidation($model);
        $this->renderPartial('_privacySettings', array(
            'model' => $model,
            'usersGroups' => $usersGroups,
                ), false, true);
    }

    public function actionPrivacySettings() {
        $model = new Dokumente;

        if (isset($_POST['status'])) {
            $status = $_POST['status'];
            Yii::log('DokumenteController:actionDialogPrivacySettings= status' . $status, 'info', 'application');

            if ($status == 1) {
                if (Yii::app()->request->isAjaxRequest) {
                    $this->renderPartial('_privacySettings', array(
                        'div' => 'test',
                            ), false, true);
                }
            } elseif ($status == 2) {
                $usersGroups = $model->usergroups;
                $this->performAjaxValidation($model);
                $this->renderPartial('_privacySettings', array(
                    'model' => $model,
                        //'usersGroups' => $usersGroups, 
                        ), false, true);
            }
        }
    }

    public function actionListbox($condition = NULL, $params = NULL) {
        if (isset($attributes) && isset($values))
            $data = Dokumente::model()->findAll($condition, $params);
        else
            $data = Dokumente::model()->findAll();

        $data = CHtml::listData($data, 'idproject', 'project_name');
        foreach ($data as $value => $name) {

            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function rendermenu() {
                             
                               
                             //$this->rendermenu();  
                 
                                $this->beginWidget('zii.widgets.CPortlet', array(
                                    'title' => $this->menuTitle,
                                    //'htmlOptions' => array('class' => 'portlet-content'),
                                ));
                  
                   $this->widget(
            'CTreeView', array('url' => array('/dokumente/dokumente/ajaxFillTree'),
                'animated' => 'fast', 
                'collapsed' => true,
                
                ));
                           
$this->endWidget();  
    }

    /**
     *
     * get array for main menu 
     * @return array the menu items to be rendered recursively
     */
    public function getButtonmenu() {
       
        return  array(
                            array('label' => Yii::t('app', 'List'), 'url' => array('/index'), 'encodeLabel' => false),
                            array('label' => Yii::t('app', 'Create'), 'url' => array('/create'), 'encodeLabel' => false),
                            array('label' => Yii::t('app', 'Edit'), 'url' => array('/update'), 'encodeLabel' => false),
                        );
    }

}
