<?php

/**
 * This is the controller class for file operations
 *
 * @package module.dokumente.controllers.FileController
 * @category Dokumenten Verwaltung
 * @author Söhnke Mundt
  */
class FileController extends Controller {

    /**
     * @var array of menu items, for the left box headermenu
     */
    public $menuLeft;

    /**
     * @var array of menu items, for the right box headermenu
     */
    public $menuRight;

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('index', 'view', 'create', 'upload', 'multiupload', 'filebrowser', 'fileexplorer', 'updatedialog', 'fileact', 'test'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all other users
                'users' => array('*'),
            ),
        );
    }

    public function actions() {
        return array(
            'upload' => array(
                'class' => 'xupload.actions.XUploadAction',
                //'path' =>Yii::app() -> getBasePath() . "/../uploads",
                'publicPath' => Yii::app()->getBaseUrl() . "/uploads",
            ),
        );
    }

    /**
     * Single queued file upload
     */
    public function actionMultiupload() {
        //$this->layout = 'column2_file_layout';
        Yii::import("xupload.models.XUploadForm");
        $dir = "";
        if (isset($_GET['dir']))
            $dir = $_GET['dir'];
        $model = new XUploadForm;
        if (Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;

            echo CJSON::encode(array(
                'status' => 'failure',
                'formname' => 'multiupload',
                'content' => $this->renderPartial('multiupload_form', array(
                    'model' => $model,
                    'dir' => $dir), true, FALSE),
            ));

            exit();
        } else {
            $this->layout = '//layouts/iframe';
            $this->render('multiupload_form', array(
                'model' => $model,
                'dir' => $dir
            ));
        }
    }

    public function actionTest() {
        $model = new DFile();
        $this->layout = 'column1_file_layout';
        if (isset($_GET['act'])) {
            if ($this->debug)
                Yii::log('Filecontroller->actionUpdatedialog->$_GET[act]= ' . $_GET['act'], 'info', 'dokumente');

            $model->act = $_GET['act'];
            if (isset($_GET['dir']))
                $model->dir = $_GET['dir'];
            if (isset($_GET['path']))
                $model->path = $_GET['path'];
            if (isset($_GET['mimeType']))
                $model->mimeType = $_GET['mimeType'];

            if (in_array(strtolower($model->mimeType), $this->getModule()->mimeType)) {
                Yum::setFlash(Yii::t('DokumenteModule.file', 'was successfully created'));
            } else {
                Yii::app()->user->setFlash('notice', array('title' => Yii::t('DokumenteModule.file', 'warning'), 'text' => 'minetype not allowed'));
                CApplication::end();
            }
        }
        $this->render('open_form', array(
            'model' => $model,
        ));
    }

    public function actionIndex() {
        $model = new DFile('scan');
        // $output = shell_exec( " cp -r -a /var/www/versinfo.txt /var/www/toweb/protected/runtime 2>&1 " );
        // Yii::log('FileController:actionFileact:$output= '.$output, 'info', 'application');
        // $this->twLog($output);
        $model->path = "/var/www";
        $model->targetDir = "/var/www";
        if (isset($_GET['path'])) {
            $model->path = urldecode($_GET['path']);
        }
        if (isset($_GET['target'])) {
            $model->targetDir = $_GET['target'];
        }

        $dataProvider = $model->scan();
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['*.js'] = false;

            echo $this->renderPartial('_grid', array(
                'model' => $model,
                'dataProvider' => $dataProvider,
                'dir' => $model->path,
                    ), true, false);

            CApplication::end();
        } else {
            $this->render('index', array(
                'model' => $model,
                'dataProvider' => $dataProvider,
                'dir' => $model->path,
            ));
        }
    }

    public function actionFileExplorer() {
        $model = new DFile('scan');

        $this->layout = '//layouts/column1';
       
        if (isset($_GET['path'])) {
            $model->path = realpath(urldecode($_GET['path']));
            //$model->dir = realpath(urldecode($_GET['path']));
            $model->site = urldecode($_GET['site']);
            if ($this->debug)
            //Yii::log('Filecontroller->actionFileExplorer->$model->path= ' . $model->path, 'info', 'dokumente');
                $this->twLog($model->path);
        }else {
            if(Yii::app()->user->isAdmin()){
              $model->path = realpath(urldecode(Yii::app()->params["wsdir"]));
            $model->dir = realpath(urldecode(Yii::app()->params["wsdir"])); 
            
            }else{
                          $model->path = realpath(urldecode(Yii::app()->params["wsdir"]));
            $model->dir = realpath(urldecode(Yii::app()->params["wsdir"]));    
            }
            
        }
        if (isset($_GET['target'])) {
            $model->targetDir = realpath(urldecode($_GET['target']));
        }
        $dataProvider = $model->scan();
        if (Yii::app()->request->isAjaxRequest) {
            $this->twLog("ajax");
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            if ($model->site == "left") {

                echo $this->renderPartial('_grid_left', array(
                    'model' => $model,
                    'dataProvider' => $dataProvider,
                    'dir' => $model->path,
                        ), true, false);

                exit();
            } else {
                echo $this->renderPartial('_grid_right', array(
                    'model' => $model,
                    'dataProvider' => $dataProvider,
                    'dir' => $model->path,
                        ), true, false);

                exit();
            }
        } else {

            $this->render('fileExplorer', array(
                'model' => $model,
                'dataProvider' => $dataProvider,
                'dir' => $model->path,
            ));
        }
    }

    public function actionAdminFileExplorer() {
        $model = new DFile('adminScan');

        $this->layout = '//layouts/column1';
        if (isset($_GET['link'])) {
            $model->path = realpath(urldecode($_GET['link']));
            $model->dir = realpath(urldecode($_GET['link']));
            $model->targetDir = realpath(urldecode($_GET['link']));
            //$model->dir = realpath(urldecode($_GET['link']));
        }
        if (isset($_GET['path'])) {
            $model->path = realpath(urldecode($_GET['path']));
            //$model->dir = realpath(urldecode($_GET['path']));
            $model->site = urldecode($_GET['site']);
            if ($this->debug)
                Yii::log('Filecontroller->actionFileExplorer->$model->path= ' . $model->path, 'info', 'dokumente');
        }
        if (isset($_GET['target'])) {
            $model->targetDir = realpath(urldecode($_GET['target']));
            if ($this->debug)
                Yii::log('Filecontroller->actionFileExplorer->$model->targetDir= ' . $model->targetDir, 'info', 'dokumente');
        }
        $dataProvider = $model->adminScan();
        if (Yii::app()->request->isAjaxRequest) {
            // Stop jQuery from re-initialization
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            if ($model->site == "left") {

                echo $this->renderPartial('_grid_left', array(
                    'model' => $model,
                    'dataProvider' => $dataProvider,
                    'dir' => $model->path,
                        ), true, false);

                CApplication::end();
            } else {
                echo $this->renderPartial('_grid_right', array(
                    'model' => $model,
                    'dataProvider' => $dataProvider,
                    'dir' => $model->path,
                        ), true, false);

                CApplication::end();
            }
        } else {

            $this->render('fileExplorer', array(
                'model' => $model,
                'dataProvider' => $dataProvider,
                'dir' => $model->path,
            ));
        }
    }

    public function actionFileBrowser() {
        //$root = Yii::app()->params["uploadDir"] . 'mandant' . Yii::app()->params["mandantId"] . '/files/';<input id="lact" name="DFile[act]" type="hidden">
        $root = '/';
        $_POST['dir'] = urldecode($_POST['dir']);

        if (file_exists($root . $_POST['dir'])) {
            $files = scandir($root . $_POST['dir']);
            //Yii::app()->user->setState('path', $root . $_POST['dir']);
            natcasesort($files);
            if (count($files) > 2) { /* The 2 accounts for . and .. */
                echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
                //echo "<ul class=\"jqueryFileTree\">";
                // All dirs
                foreach ($files as $file) {
                    if (file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && is_dir($root . $_POST['dir'] . $file)) {
                        echo "<li class=\"directory collapsed\">";
                        echo "<a href=\"#\"  id=\"" . htmlentities($_POST['dir'] . $file) . "\" rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">" . htmlentities($file) . "</a>";
                        echo "<div class=\"listtlb\">";
                        echo "<span class=\"tlb\">";
                        echo "<a href=\"#\" class=\"paste\"  rel=\"" . htmlentities($_POST['dir'] . $file) . "/\">";
                        echo "&nbsp;&nbsp;";
                        echo "</a>";
                        echo "</span> ";
                        echo "</div>";
                        echo "</li>";
                    }
                }
                // All files
                foreach ($files as $file) {
                    if (file_exists($root . $_POST['dir'] . $file) && $file != '.' && $file != '..' && !is_dir($root . $_POST['dir'] . $file)) {
                        $ext = preg_replace('/^.*\./', '', $file);
                        echo "<li class=\"file ext_$ext\"><a href=\"#\" id=\"" . htmlentities($_POST['dir'] . $file) . "\" rel=\"" . htmlentities($_POST['dir'] . $file) . "\">" . htmlentities($file) . "</a></li>";
                    }
                }
                echo "</ul>";
            }
        }
    }
    


    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionFileact() {
        $model = new DFile();
        $allFilesIds = array();
        $files = array();
        $i = 0;
        $result = '';


        if ((isset($_POST['DFile']))) {

            $model->attributes = $_POST['DFile'];
            $model->path = realpath($model->dir);
            // $model->dir = realpath($model->dir);
            $allFilesIds = explode(",", $model->select);


            if (count($allFilesIds) > 0) {
                $files = $model->scan();
                $files = $files->getData();
                if ($model->act == 'copy') {
                    foreach ($allFilesIds as $fId) {
                        $result = $model->doAction($files[$fId]['path'], $model->targetDir . DIRECTORY_SEPARATOR . $files[$fId]['name']);
                    }
                    if (($result == '') || ($result)) {
                        Yii::log('copy ' . $files[$fId]['path'] . ' ' . $model->targetDir . DIRECTORY_SEPARATOR . $files[$fId]['name'], 'info', 'fileOperation');
                        echo CJSON::encode(array(
                            'status' => 'success',
                            'title' => Yii::t('DokumenteModule.file', 'successfully'),
                            'content' => Yii::t('DokumenteModule.file', '{file} was successfully copied', array('{file}' => $files[$fId]['path'])),
                        ));
                    } else {
                        echo CJSON::encode(array(
                            'status' => 'failure',
                            'title' => Yii::t('DokumenteModule.file', 'not successfully'),
                            'content' => Yii::t('DokumenteModule.file', '{file} was not successfully copied', array('{file}' => $files[$fId]['path'])),
                        ));
                    }
                } elseif ($model->act == 'move') {
                    foreach ($allFilesIds as $fId) {
                        $result = $model->doAction($files[$fId]['path'], $model->targetDir . DIRECTORY_SEPARATOR . $files[$fId]['name']);
                    }
                    if (($result == '') || ($result)) {
                        Yii::log('move ' . $files[$fId]['path'] . ' ' . $model->targetDir . DIRECTORY_SEPARATOR . $files[$fId]['name'], 'info', 'fileOperation');
                        echo CJSON::encode(array(
                            'status' => 'success',
                            'title' => Yii::t('DokumenteModule.file', 'successfully'),
                            'content' => Yii::t('DokumenteModule.file', '{file} was successfully moved', array('{file}' => $files[$fId]['path'])),));
                    } else {
                        echo CJSON::encode(array(
                            'status' => 'failure',
                            'title' => Yii::t('DokumenteModule.file', 'not successfully'),
                            'content' => Yii::t('DokumenteModule.file', '{file} was not successfully moved', array('{file}' => $files[$fId]['path'])),
                        ));
                    }
                } elseif ($model->act == 'delete') {
                    foreach ($allFilesIds as $fId) {
                        $result = $model->doAction($files[$fId]['path'], '');
                    }
                    if (($result == '') || ($result)) {
                        Yii::log('delete ' . $files[$fId]['path'] . ' ' . $model->targetDir . DIRECTORY_SEPARATOR . $files[$fId]['name'], 'info', 'fileOperation');
                        echo CJSON::encode(array(
                            'status' => 'success',
                            'title' => Yii::t('DokumenteModule.file', 'successfully'),
                            'content' => Yii::t('DokumenteModule.file', '{file} was successfully deleted', array('{file}' => $files[$fId]['path'])),));
                    } else {
                        echo CJSON::encode(array(
                            'status' => 'failure',
                            'title' => Yii::t('DokumenteModule.file', 'not successfully'),
                            'content' => Yii::t('DokumenteModule.file', '{file} was not successfully deleted', array('{file}' => $files[$fId]['path'])),
                        ));
                    }
                }
                Yii::app()->end();
            }
        }
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdatedialog() {
        $model = new DFile();
        $act = "create";
        $formname = "";
        $title = "";
        $text = "";
        if (isset($_POST['DFile'])) {
            $model->attributes = $_POST['DFile'];

            if ($model->act == "create") {
                if ($model->create()) {
                    $this->twLog("nach if create" . $model->act);
                    echo CJSON::encode(array(
                        'status' => 'success',
                        'title' => Yii::t('DokumenteModule.file', 'successfully'),
                        'content' => Yii::t('DokumenteModule.file', 'was successfully created')));
                   
                    CApplication::end();
                }
                // echo CHtml::script("$( '#updateDialog').dialog( 'close' )");
                CApplication::end();
            } elseif ($model->act == "rename") {
                if ($model->rename()) {
                    echo CJSON::encode(array(
                        'status' => 'success',
                        'title' => Yii::t('DokumenteModule.file', 'successfully'),
                        'content' => Yii::t('DokumenteModule.file', 'was successfully renamed')));
                    CApplication::end();
                }
            }elseif ($model->act == "owners") {
                if ($model->chown()) {
                   if(Yii::app()->params['env'] == "dev"){
                        $this->twLog('$model->act=' . $model->act,'dev'); 
                        $this->twLog('$model->uid=' . $model->uid,'dev');
                        $this->twLog('$model->gid=' . $model->gid,'dev'); 
                }
                    echo CJSON::encode(array(
                        'status' => 'success',
                        'title' => Yii::t('DokumenteModule.file', 'successfully'),
                        'content' => Yii::t('DokumenteModule.file', '{file} was successfully change owners', array('{file}' => $model->path)),));
                    CApplication::end();
                }
            }elseif ($model->act == "permissions") {
                if(Yii::app()->params['env'] == "dev"){
                   $this->twLog('$model->act=' . $model->act,'dev'); 
                   $this->twLog('$model->permissions=' . $model->permissions,'dev'); 
                }
                    
                 
                 echo CHtml::script("$.notify({
                        title: 'log',
                        text: " . $model->permissions . ",
                        type: 'success',
                        opacity: .8
                    });");
                if ($model->chperm()) {
                    echo CHtml::script("$.notify({
                        title: 'log',
                        text: " . $model->permissions . ",
                        type: 'success',
                        opacity: .8
                    });");
                     echo CHtml::script("$.notify({
                        title: " . Yii::t('DokumenteModule.file', 'successfully') . ",
                        text: " . Yii::t('DokumenteModule.file', '{file} was successfully change permissions', array('{file}' => $model->path)) . ",
                        type: 'success',
                        opacity: .8
                    });");
                    echo CJSON::encode(array(
                        'status' => 'success',
                        'title' => Yii::t('DokumenteModule.file', 'successfully'),
                        'content' => Yii::t('DokumenteModule.file', 'was successfully change permissions')));
                    CApplication::end();
                }
            } elseif ($model->act == "edit") {
                if ($model->saveChangedFile()) {
                    //Yii::app()->user->setFlash('success', array('title' => Yii::t('DokumenteModule.file', 'successfully'), 'text' => Yii::t('DokumenteModule.file', 'save changed file successfully')));
                    echo CHtml::script("window.parent.$('#cru-dialog').dialog('close');window.parent.$('#cru-frame').attr('src','');window.parent.$.fn.yiiGridView.update('{$model->grid_id}');");
                    echo CHtml::script("$.notify({
                        title: " . Yii::t('DokumenteModule.file', 'successfully') . ",
                        text: " . Yii::t('DokumenteModule.file', 'save changed file successfully') . ",
                        type: 'success',
                        opacity: .8
                    });");
                }
            }
        } else {
            if (isset($_GET['act'])) {
                if ($this->debug)
                    Yii::log('Filecontroller->actionUpdatedialog->$_GET[act]= ' . $_GET['act'], 'info', 'dokumente');

                $model->act = $_GET['act'];
                if (isset($_GET['dir']))
                    $model->dir = $_GET['dir'];
                if (isset($_GET['path']))
                    $model->path = $_GET['path'];
                if (isset($_GET['name']))
                    $model->name = $_GET['name'];
                if (isset($_GET['mimeType']))
                    $model->mimeType = $_GET['mimeType'];
                if (isset($_GET['permissions']))
                    $model->permissions = $_GET['permissions'];
                if (isset($_GET['uid']))
                    $model->uid = $_GET['uid'];
                if (isset($_GET['gid']))
                    $model->gid = $_GET['gid'];
                
                $formname = $model->act;
                if ($model->act == "create") {
                    $this->twLog("nach " . $model->act);
                    Yii::log('FileController:actionUpdatedialog: $model->dir= ' . $model->dir, 'info', 'dokumente');
                } elseif ($model->act == "rename") {
                    $model->oldname = $_GET['name'];
                    $model->name = $_GET['name'];
                } elseif ($model->act == "open") {
                    if (Yii::app()->user->isAdmin()) {
                        if ($model->open()) {
                            Yii::log('FileController:actionUpdatedialog: open $model->path= ' . $model->path, 'info', 'dokumente');
                            Yii::app()->user->setFlash('success', array('title' => Yii::t('DokumenteModule.file', 'successfully'), 'text' => Yii::t('DokumenteModule.file', 'open successfully')));
                            $model->act = "edit";
                        } else {
                            Yii::app()->user->setFlash('notice', array('title' => Yii::t('DokumenteModule.file', 'warning'), 'text' => 'minetype not allowed'));
                        }
                    } else {

                        if (in_array(strtolower($model->mimeType), $this->getModule()->mimeType)) {
                            if ($model->open()) {
                                Yii::log('FileController:actionUpdatedialog: open $model->mimeType= ' . $model->mimeType, 'info', 'dokumente');
                                Yii::app()->user->setFlash('success', array('title' => Yii::t('DokumenteModule.file', 'successfully'), 'text' => Yii::t('DokumenteModule.file', 'open successfully')));
                                $model->act = "edit";
                            } else {
                                Yii::app()->user->setFlash('notice', array('title' => Yii::t('DokumenteModule.file', 'warning'), 'text' => 'minetype not allowed'));
                            }
                        } else {
                            Yii::app()->user->setFlash('notice', array('title' => Yii::t('DokumenteModule.file', 'warning'), 'text' => 'minetype not allowed'));
                            CApplication::end();
                        }
                    }
                }
            }
            if (Yii::app()->request->isAjaxRequest) {
                Yii::app()->clientScript->scriptMap['jquery.js'] = false;

                echo CJSON::encode(array(
                    'status' => 'failure',
                    'content' => $this->renderPartial($formname . '_form', array(
                        'model' => $model), true, true),
                ));

                exit();
            } else {
                $this->layout = '//layouts/iframe';
                $this->render($formname . '_form', array(
                    'model' => $model,
                ));
            }
        }
    }

    public function actionUploadx($dir) {

        Yii::log('DokumenteController:actionUpload:$id= ' . $id, 'info', 'application');
        Yii::log('DokumenteController:actionUpload:$this->m->erfassid= ' . $this->m->erfassid, 'info', 'dokumente');
        //Yii::import("dokumente.extensions.EAjaxUpload.qqFileUploader");
        $folder = $dir; // folder for uploaded files
        Yii::log('DokumenteController:actionUpload:$folder= ' . $folder, 'info', 'dokumente');

        $allowedExtensions = array("svg", "txt", "doc", "docx", "odt", "rtf", "xml", "xls", "jpg", "jpeg", "gif", "doc", "pdf", "ini", "html", "php", "cfg", "conf", "htm"); //array("jpg","jpeg","gif","exe","mov" and etc...
        $sizeLimit = 2 * 1024 * 1024; // maximum file size in bytes
        $uploader = new application . modules . dokumente . extensions . EAjaxUpload . qqFileUploader($allowedExtensions, $sizeLimit);
        if (!Yii::app()->file->set($folder, true)->exists) {
            Yii::log('!Yii::app()->file->set($folder, true)->exists', 'info', 'application');
            if (Yii::app()->file->createDir(0775, $folder)) {
                $result = $uploader->handleUpload($folder);
                $result = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
                Yii::log('DokumenteController:actionUpload= Verzeichnisse angelegt', 'info', 'dokumente');
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

}

