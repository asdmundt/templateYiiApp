<?php

class ImagesController extends Controller {

    public $layout = '//layouts/column2';

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('create', 'update', 'index', 'view', 'multiupload', 'upload'),
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

    public function actionView() {
        $this->render('view', array(
            'model' => $this->loadModel(),
        ));
    }

    public function actionCreate() {
        $model = new Images;

        $this->performAjaxValidation($model);

        if (isset($_POST['Images'])) {
            $model->attributes = $_POST['Images'];


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

        if (isset($_POST['Images'])) {
            $model->attributes = $_POST['Images'];

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
        }
        else
            throw new CHttpException(400, Yii::t('app', 'Invalid request. Please do not repeat this request again.'));
    }

    public function actionUpload() {
     Yii::import( "xupload.models.XUploadForm" );
    //Here we define the paths where the files will be stored temporarily
    $path = realpath( Yii::app( )->getBasePath( )."/../images/uploads/tmp/" )."/";
    $publicPath = Yii::app( )->getBaseUrl( )."/images/uploads/tmp/";
 
    //This is for IE which doens't handle 'Content-type: application/json' correctly
    header( 'Vary: Accept' );
    if( isset( $_SERVER['HTTP_ACCEPT'] ) 
        && (strpos( $_SERVER['HTTP_ACCEPT'], 'application/json' ) !== false) ) {
        header( 'Content-type: application/json' );
    } else {
        header( 'Content-type: text/plain' );
    }
 
    //Here we check if we are deleting and uploaded file
    if( isset( $_GET["_method"] ) ) {
        if( $_GET["_method"] == "delete" ) {
            if( $_GET["file"][0] !== '.' ) {
                $file = $path.$_GET["file"];
                if( is_file( $file ) ) {
                    unlink( $file );
                }
            }
            echo json_encode( true );
        }
    } else {
        $model = new XUploadForm;
        $model->file = CUploadedFile::getInstance( $model, 'file' );
        //We check that the file was successfully uploaded
        if( $model->file !== null ) {
            //Grab some data
            $model->mime_type = $model->file->getType( );
            $model->size = $model->file->getSize( );
            $model->name = $model->file->getName( );
            //(optional) Generate a random name for our file
            $filename = md5( Yii::app( )->user->id.microtime( ).$model->name);
            $filename .= ".".$model->file->getExtensionName( );
            if( $model->validate( ) ) {
                //Move our file to our temporary dir
                $model->file->saveAs( $path.$filename );
                chmod( $path.$filename, 0777 );
                //here you can also generate the image versions you need 
                //using something like PHPThumb
 
 
                //Now we need to save this path to the user's session
                if( Yii::app( )->user->hasState( 'images' ) ) {
                    $userImages = Yii::app( )->user->getState( 'images' );
                } else {
                    $userImages = array();
                }
                 $userImages[] = array(
                    "path" => $path.$filename,
                    //the same file or a thumb version that you generated
                    "thumb" => $path.$filename,
                    "filename" => $filename,
                    'size' => $model->size,
                    'mime' => $model->mime_type,
                    'name' => $model->name,
                );
                Yii::app( )->user->setState( 'images', $userImages );
 
                //Now we need to tell our widget that the upload was succesfull
                //We do so, using the json structure defined in
                // https://github.com/blueimp/jQuery-File-Upload/wiki/Setup
                echo json_encode( array( array(
                        "name" => $model->name,
                        "type" => $model->mime_type,
                        "size" => $model->size,
                        "url" => $publicPath.$filename,
                        "thumbnail_url" => $publicPath."thumbs/$filename",
                        "delete_url" => $this->createUrl( "upload", array(
                            "_method" => "delete",
                            "file" => $filename
                        ) ),
                        "delete_type" => "POST"
                    ) ) );
            } else {
                //If the upload failed for some reason we log some data and let the widget know
                echo json_encode( array( 
                    array( "error" => $model->getErrors( 'file' ),
                ) ) );
                Yii::log( "XUploadAction: ".CVarDumper::dumpAsString( $model->getErrors( ) ),
                    CLogger::LEVEL_ERROR, "xupload.actions.XUploadAction" 
                );
            }
        } else {
            throw new CHttpException( 500, "Could not upload file" );
        }
    }
    }

    public function actionMultiupload_() {

        Yii::import("xupload.models.XUploadForm");
        $model = new XUploadForm;
               if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;

            echo CJSON::encode(array(
                'status' => 'failure',
                'content' => $this->renderPartial('multiupload', array(
                    'model' => $model,
                    ), true, FALSE),
            ));
        }
       
    }

    public function actionMultiupload() {
        $model = new Images;
        Yii::import("xupload.models.XUploadForm");
        $photos = new XUploadForm;
        //Check if the form has been submitted
        if (isset($_POST['Images'])) {
            //Assign our safe attributes
            $model->attributes = $_POST['Images'];
            //Start a transaction in case something goes wrong
            $transaction = Yii::app()->db->beginTransaction();
            try {
                //Save the model to the database
                if ($model->save()) {
                    $transaction->commit();
                    echo CJSON::encode(array(
                        'status' => 'success',
                        'title' => Yii::t('ImageManagerModule.images', 'successfully'),
                        'content' => Yii::t('ImageManagerModule.images', 'upload images')));
                }
            } catch (Exception $e) {
                $transaction->rollback();
                Yii::app()->handleException($e);
            }
        }
        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;

            echo CJSON::encode(array(
                'status' => 'failure',
                'content' => $this->renderPartial('multiupload', array(
                    'model' => $model,
                    'photos' => $photos,), true, FALSE),
            ));
        }
        exit();
    }

    public function actionIndex() {
        $id = 1;
        $model = new Images();
        if (isset($_GET['imagestree_id']))
            $id = $_GET['imagestree_id'];
        $dataProvider = new CActiveDataProvider('Images', array(
            'criteria' => array(
                'condition' => 'imagestree_id=' . $id,
            )
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
        ));
    }
    
        public function actionList() {
        $id = 1;
        $model = new Images();
        if (isset($_GET['imagestree_id']))
            $id = $_GET['imagestree_id'];
        $dataProvider = new CActiveDataProvider('Images', array(
            'criteria' => array(
                'condition' => 'imagestree_id=' . $id,
            )
        ));
       if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;

            echo CJSON::encode(array(
                'status' => 'failure',
                'content' => $this->renderPartial('_list', array(
                   'dataProvider' => $dataProvider
                    ), true, FALSE),
            ));
        }
        exit();
       
    }

    public function actionAdmin() {
        $model = new Images('search');
        if (isset($_GET['Images']))
            $model->attributes = $_GET['Images'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'images-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function rendermenu() {


        //$this->rendermenu();  

        $this->beginWidget('zii.widgets.CPortlet', array(
            'title' => $this->menuTitle,
                //'htmlOptions' => array('class' => 'portlet-content'),
        ));

        $this->widget(
                'CTreeView', array('url' => array('/imageManager/imagestree/ajaxFillTree'),
            'animated' => 'fast',
            'collapsed' => true,
        ));

        $this->endWidget();
    }

}
