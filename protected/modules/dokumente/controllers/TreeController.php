<?php

/**
 * This is the controller class for Tree logic.
 *
 * @package module.dokumente.controllers.TreeController
 * @author $Author$
 * @link http://46.163.72.165/toweb/
 * @version $Id: TreeController.php 1632 2012-10-07 22:44:13Z  $
 */
class TreeController extends AsdDokumenteModuleController {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Returns a list of external action classes.
     * @return array list of external action classes
     */
    public function actionView() {
        $this->render('view', array(
            'model' => $this->loadModel(),
        ));
    }

    public function actionCreate() {
        $model = new Tree;

        $this->performAjaxValidation($model);

        if (isset($_POST['Tree'])) {
            $model->attributes = $_POST['Tree'];


            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    public function actionUpdate() {
        $model = $this->loadModel();

        $this->performAjaxValidation($model);

        if (isset($_POST['Tree'])) {
            $model->attributes = $_POST['Tree'];

            if ($model->save())
                $this->redirect(array('view', 'id' => $model->id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete() {
        if (Yii::app()->request->isPostRequest) {
            $this->loadModel()->delete();

            if (!isset($_GET['ajax']))
                $this->redirect(array('index'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Tree');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Tree('search');
        if (isset($_GET['Tree']))
            $model->attributes = $_GET['Tree'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'tree-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
