<?php
/*
 * @author $Author$
 * @link http://46.163.72.165/toweb/
 * @version $Id: EditorController.php 1632 2012-10-07 22:44:13Z  $
 */
class EditorController extends AsdDokumenteModuleController
{
	

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
        
            public function beforeRender($view) {
        parent::beforeRender($view);
        $history = Browsehistory::getInstance();
        $this->tabmenu = $history->items();
        if ((!empty($_GET['asDialog'])) || (!empty($_POST['asDialog']))) {
            $this->baseLayout = '//layouts/main_iframe';
            if (($_GET['asDialog'] > 1) || ($_POST['asDialog'] > 1)) {
                $this->layout = '/layouts/column2_file_layout';
            } else {
                $this->layout = '/layouts/column1_dokumente_layout';
            }
        } else {
            $this->baseLayout = '//layouts/main';
            $this->layout = '//layouts/column2';
        }
        return true;
    }


	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Tree;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tree']))
		{
			$model->attributes=$_POST['Tree'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Tree']))
		{
			$model->attributes=$_POST['Tree'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Tree('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Tree']))
			$model->attributes=$_GET['Tree'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tree-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
          	/**
         *
	 * get array for main menu
	 * @return array the menu items to be rendered recursively
	 */

    public function getMainmenu() {
       return array(
        array('label'=>Yii::t('DokumenteModule.file', 'Files'), 'url'=>array('/kontakt/kontakte/index')),
        array('label'=>Yii::t('DokumenteModule.file', 'List adresses'), 'url'=>array('/kontakt/adresse/index')),
        array('label'=>Yii::t('DokumenteModule.file', 'List communikationdata'), 'url'=>array('/kontakt/kommunikation/index')),
	array('label'=>Yii::t('DokumenteModule.file', 'List bankingdata'), 'url'=>array('/kontakt/bankdaten/index')),

);
    }

}
