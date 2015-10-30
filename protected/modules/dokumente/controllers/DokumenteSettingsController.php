<?php
 /**
  * @author $Author$
 * @link http://46.163.72.165/toweb/
 * @version $Id: DokumenteSettingsController.php 1632 2012-10-07 22:44:13Z  $
  */
class DokumenteSettingsController extends AsdDokumenteModuleController
{
	/**rhislo@web.de
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	

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
         * 
          
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
				'expression'=>'Yii::app()->user->getState("art") < 2',
			),
			
		);
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='dokumente-dialog')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionPrivacySettingsDialog()
        {
            
            $model= new DokumenteHasUsergroup();

            Yii::log('DokumenteSettingsController:actionDialogPrivacySettings', 'info', 'application');
            $usersGroups= YumUsergroup::model()->findAll(
                 );
            if(isset($_GET['id'])){
			$id=$_GET['id'];
                        
                        Yii::log('DokumenteSettingsController:actionDialogPrivacySettings= status'.$id, 'info', 'application');
            }            
     // $this->performAjaxValidation($model);
            $this->renderPartial('privacySettingsDialog',array(
			 'usersGroups'=>$usersGroups
                    ),false,true);
        }
        
               public function actionPrivacySettings()
        {
            
            
            $usersGroups= YumUsergroup::model()->findAll(
                 );
     // $this->performAjaxValidation($model);
            $this->renderPartial('_privacySettings',array(
			'model'=>$model,
                        'usersGroups'=>$usersGroups,
                    ),false,true);
        }
}
