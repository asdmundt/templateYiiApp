<?php

/**
 * This is the model class for File Form.
 *

 
 * @package module.dokumente.models.Dokumente
 * @author Söhnke Mundt
 * @copyright Copyright &copy; 2011 ASDMUNDT
 * @link http://46.163.72.165/toweb/
 * @version 1.1 
 */
class DFile extends CFormModel {
    
    /**
     * @var int pkey.
     */
    public $id;
    
    /**
     * @var string mimeType of the file.
     */
    public $mimeType;
    
       /**
     * @var int filesize.
     */
    public $size;
    
      /**
     * @var string name of the file.
     */
    public $name;

     /**
     * @var string name of the file.
     */
    public $uid;

       /**
     * @var string name of the file.
     */
    public $gid;
    
      /**
     * @var string name of the file.
     */
    public $oldname;
    
      /**
     * @var string value of permissions eg.`0755`.
     */
    public $permissions;
    
    
    public $path = "";
    
    
    public $grid_id;
    
    
    public $select;
    
    
    public $countData;
    
       /**
     * @var object CFile instance for the specified filesystem object
     */
    public $file;
    
    public $fileContent;
    public $dir;
    public $targetDir;
    public $act;
    public $site;
    public $fid;
    public $items = array();
    
    private $_logTag='fileOperation';

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules() {
        return array(
            array('path, name, formaction,dir, targetDir,act,select,fileContent,uid,gid,permissions', 'safe'),
            //array('file', 'file'),
            //array('dir, name', 'required', 'on' => 'create'),
            //array('dir, name, oldname', 'required', 'on' => 'rename'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'name' => 'Name',
            'path' => 'Pfad',
            'permissions'=> 'Rechte',
            'uid'=> 'User',
            'gid'=> 'Gruppe',
        );
    }

    /**
     * scan
     * @author Söhnke Mundt 
     * this function build ArrayDataProvider
     * to render stuff for filegrid
     * @see DDirectory
     * @access	public
     * @return	array of file objects
     */
    public function scan() {

        //$path_up = substr( $path_dir, 0, strrpos( $path_dir, '/', -2 ) )."/";
       if($this->isWindows()){
           
       }else{
        if(Yii::app()->user->isAdmin()){
            $rawData = DDirectory::getAdminArray($this->path);
            //$rawData = DDirectory::getArray($this->path);
        }else{
            $rawData = DDirectory::getArray($this->path);
        }
       }
        $this->items = $rawData;
        if (count($rawData) > 0) {
            $this->countData = count($rawData);
            $dataProvider = new CArrayDataProvider($rawData, array(
                'id' => 'DFile',
                'sort' => array(
                    'attributes' => array(
                        'name', 'size', 'modified',
                    ),
                ),
                'pagination' => false,
                    ));
        } else {

            $dataProvider = null;
        }
        //$dataProvider->getData();
        return $dataProvider;
    }
    
        /**
     * scan
     * @author Söhnke Mundt 
     * this function build ArrayDataProvider
     * to render stuff for filegrid
     * @see DDirectory
     * @access	public
     * @return	array of file objects
     */
    public function adminScan() {

        //$path_up = substr( $path_dir, 0, strrpos( $path_dir, '/', -2 ) )."/";
        $rawData = DDirectory::getAdminArray($this->path);
        $this->items = $rawData;
        if (count($rawData) > 0) {
            $this->countData = count($rawData);
            $dataProvider = new CArrayDataProvider($rawData, array(
                'id' => 'DFile',
                'sort' => array(
                    'attributes' => array(
                        'name', 'size', 'modified',
                    ),
                ),
                'pagination' => false,
                    ));
        } else {

            $dataProvider = null;
        }
        //$dataProvider->getData();
        return $dataProvider;
    }

    /**
     * createfile
     * 
     * this function build ArrayDataProvider
     * to render stuff for filegrid
     * @name create
     * @see DDirectory
     * @access	public
     * @return	array of file objects
     * @author Söhnke Mundt 
     */
    public function create() {

        $filename = $this->dir . DIRECTORY_SEPARATOR . $this->name;
        $pos = strpos($this->name, '.');
        //$output_str = shell_exec("echo ".Yii::app()->params['sudopwd']." | sudo -S  ls -la --time-style=+%d.%m.%Y-%T ".$directory." 2>&1 &");
        if (substr_count($this->name, '.') > 0) {
            if (Yii::app()->file->set($filename)->create() !== false) {
                Yii::log('DFile->create=$model->filename= ' . $filename. ' created', 'info', 'fileOperation');
                return true;
            } else {
                Yii::log('DFile->rename=$model->filename= ' . $this->name . 'not created', 'error', 'dokumente');
                return FALSE;
            }
        } else {
            if (Yii::app()->file->set($filename . DIRECTORY_SEPARATOR)->createDir() !== false) {
                Yii::log('DFile->create=$model->filename= ' . $filename. ' created', 'info', 'fileOperation');
                return true;
            } else {
                Yii::log('DFile->rename=$model->filename= ' . $this->name . 'not created', 'error', 'dokumente');
                return FALSE;
            }
        }
    }

    /**
     * rename fileobject
     * @author Söhnke Mundt 
     * @name rename
     * @access	public
     * @return	true
     */
    public function rename() {

        $filename = $this->dir . DIRECTORY_SEPARATOR . $this->oldname;
        $newfile = Yii::app()->file->set($filename);
        if ($newfile->rename($this->name) !== false) {
            Yii::log('DFile->rename=$model->filename= ' . $this->name . ' renamed', 'info', 'fileOperation');
            return true;
        } else {
            Yii::log('DFile->rename=$model->filename= ' . $this->name . 'not renamed', 'error', 'dokumente');
            return FALSE;
        }
    }
    
        /**
     * change permissions of fileobject
     * @author Söhnke Mundt 
     * @name chperm
     * @access	public
     * @return	true
     */
    public function chperm() {

        
        $fileobj = Yii::app()->file->set($this->path,true);
        $fileobj->setPermissions($this->permissions);
        Yii::log('DFile->rename=permissions= ' . $this->permissions . ' change permissions', 'info', 'dokumente');
        if ($fileobj = true) {
           Yii::log('DFile->rename=$model->filename= ' . $this->name . ' change permissions', 'info', 'fileOperation');
            return true;
        } else {
            Yii::log('DFile->chown=$model->filename= ' . $this->name . 'not change permissions', 'error', 'dokumente');
            return FALSE;
        }
    }
    
        /* change owners fileobject
     * @author Söhnke Mundt 
     * @name chown
     * @access	public
     * @return	true
     */
    public function chown() {

        
        $fileobj = Yii::app()->file->set($this->path);
        if ($fileobj->setGroup($this->gid) == false) {
            Yii::log('DFile->chown=$model->file= ' . $this->path . ' change group' . $this->gid . ' not successfully', 'error', 'fileOperation');
            return FALSE;

        } else {
            Yii::log('DFile->rename=$model->filename= ' . $this->name . ' change owner', 'info', 'fileOperation');
            return true;
        }
               if ($fileobj->setOwner($this->uid) == false) {
            Yii::log('DFile->chown=$model->file= ' . $this->path . ' change owner' . $this->gid . ' not successfully', 'error', 'fileOperation');
            return FALSE;

        } else {
            Yii::log('DFile->rename=$model->filename= ' . $this->name . ' renamed', 'info', 'fileOperation');
            return true;
        }
    }
    
     /**
     * rename fileobject
     * @author Söhnke Mundt 
     * @name rename
     * @access	public
     * @return	true
     */
    public function open() {

        $filename = $this->path;
       
        if (Yii::app()->file->set($filename)->exists) {
            $newfile = Yii::app()->file->set($filename);
            $this->file = $newfile;
            $this->fileContent = $newfile->getContents();
            Yii::log('DFile->open= ' . $this->path . Yii::t('DokumenteModule.file', 'open successfully'), 'info', 'fileOperation');
            return true;
        } else {
            if(!is_dir($this->dir)) {
                
            Yii::log('DFile->open= ' . $this->path . Yii::t('DokumenteModule.file', 'open not successfully'), 'error', 'dokumente');
            return FALSE;
        }
        }
    }
    
        /**
     * save changed file content
     * @author Söhnke Mundt 
     * @name saveChangedFile
     * @access	public
     * @return	true
     */
    public function saveChangedFile() {

        $filename = $this->path;
         $content = $this->fileContent; 
        if (Yii::app()->file->set($filename)->exists) {
            $newfile = Yii::app()->file->set($filename);
            
            $result = $newfile->setContents($content, $autocreate=FALSE, $flags=0);
            if (!$result){
                
            }
                
            Yii::log('DFile->saveChangedFile= ' . $this->path . Yii::t('DokumenteModule.file', 'save changed file successfully successfully'), 'info', 'fileOperation');
            return true;
        } else {
            Yii::log('DFile->saveChangedFile= ' . $this->path . Yii::t('DokumenteModule.file', 'save changed file not successfully'), 'error', 'dokumente');
            throw new CHttpException(500, "{$this->path} Yii::t('DokumenteModule.file', 'save changed file not successfully')");
            return FALSE;
        }
    }

    /**
     * getCountData
     *  $tmp = explode("/", trim($uri, "/")); 
     * @author Söhnke Mundt 
     * @access	public
     * @return	int size of array
     */
    public function getCountData() {

        return $this->countData;
    }
    
    /**
     * @name isWindows
     * @author Söhnke Mundt 
     * @access	public
     * @return	boolean true or false
     * 
     */
     public function isWindows()
    {
        return strtoupper(substr(php_uname('s'), 0, 3)) === 'WIN';
    }

    /**
     * getPathAsMenu
     *  
     * @
     * @author Söhnke Mundt 
     * @access	public
     * @return	array of items
     */
    public function getPathAsMenu() {

        $dirs = explode(DIRECTORY_SEPARATOR, trim($this->path, DIRECTORY_SEPARATOR));
        $count = count($dirs);
        $tmpPath = DIRECTORY_SEPARATOR . "";
        $items = array();
        if ($this->site == 'left') {
            for ($i = 0; $i < $count; $i++) {
                $tmpPath = $this->safe_dirname($tmpPath);
                $tmpPath = $tmpPath . $dirs [$i] . DIRECTORY_SEPARATOR;
                $dirs [$i] = array(
                    //array('label' => 'Delete', 'url' => 'javascript:void(0)', 'linkOptions' => array('onclick' => "showDialog('delete');"))
                    'label' => $dirs [$i],
                    'linkOptions' => array('id' => 'dirchange', 'onclick' => 'updateDirLeft("' . Yii::app()->createUrl("/dokumente/file/fileexplorer", array("path" => $tmpPath, "gridId" => "gridfileleft", "site" => "left", "asDialog" => 1)) . '","' . $tmpPath . '")'),
                    'url' => '#',
                );
            }
        } else if ($this->site == 'right') {
            for ($i = 0; $i < $count; $i++) {
                $tmpPath = $tmpPath . $dirs [$i] . DIRECTORY_SEPARATOR;
                $items[$i] = array(
                    'label' => $dirs [$i],
                    'linkOptions' => array('id' => 'dirchange', 'onclick' => 'updateDirRight("' . Yii::app()->createUrl("/dokumente/file/fileexplorer", array("path" => $tmpPath, "gridId" => "gridfileright", "site" => "right", "asDialog" => 1)) . '","' . $tmpPath . '")'),
                    'url' => '#',);
            }
        } else {
            for ($i = 0; $i < $count; $i++) {
                $tmpPath = $this->safe_dirname($tmpPath);
                $tmpPath = $tmpPath . DIRECTORY_SEPARATOR . $dirs [$i];
                $items[$i] = array(
                    'icon' => 'carat-1-e',
                    'icon-position' => 'right',
                    'label' => $dirs [$i],
                    'linkOptions' => array('id' => 'dirchange', 'onclick' => 'updateDir("' . Yii::app()->createUrl("/dokumente/file/index", array("path" => $tmpPath, "gridId" => "gridfile", "asDialog" => 2)) . '","' . $tmpPath . '")', 'onmouseover' => "Tip('" . $tmpPath . "', LEFT, true, FADEIN, 400)", 'onmouseout' => "UnTip()"),
                    'visible' => (!Yii::app()->user->isGuest),
                    'url' => '#',);
            }
        }
        return $items;
    }

    private function safe_dirname($p) {

        return str_replace('//', '/', $p);
    }
    
       private function safe_upperdir($p) {
        //$findmich  = 'a';
        //$meinstring1 = 'xyz';
        return str_replace('..', '', $p);
    }
    
        // {{{ pathToUnix
  // }}} 
    //$output_str = shell_exec("echo ".Yii::app()->params['sudopwd']." | sudo -S  ls -la --time-style=+%d.%m.%Y-%T ".$directory." 2>&1 &");
        public function doAction($src,$dest)
    {
        $result = false;
        switch($this->act)
        {
            case 'rename':
               
                if($this->isWindows()) {
                    $src    = DDirectory::pathToWindows($src);
                    $dest   = DDirectory::pathToWindows($dest);
                }
                elseif(Yii::app()->user->isAdmin())
                    $result = shell_exec("echo ".Yii::app()->params['sudopwd']." | sudo -S  mv ".$src." ".$dest." 2>&1 &");
                else
                    $result = @rename($src, $dest);
                break;
            case 'copy':
               
                if($this->isWindows()) {
                    $src    = DDirectory::pathToWindows($src);
                    $dest   = DDirectory::pathToWindows($dest);
                }
                elseif(Yii::app()->user->isAdmin())
                    $result = shell_exec("echo ".Yii::app()->params['sudopwd']." | sudo -S  cp -r ".$src." ".$dest." 2>&1 &");
                else
                    $result = $this->rcopy($src, $dest);          
                
                break;
            case 'delete':
                
                if($this->isWindows()) {
                    $src    = DDirectory::pathToWindows($src);
                }
                elseif(Yii::app()->user->isAdmin())
                    $result = shell_exec("echo ".Yii::app()->params['sudopwd']." | sudo -S  rm -r ".$src." 2>&1 &");
                else{
                 if(is_file($this->path))
                    $result = @unlink($src);
                else
                    $result = DDirectory::rrmdir($src);
                }
                break;
            case 'move':
               
                if($this->isWindows()) {
                    $src    = DDirectory::pathToWindows($src);
                    $dest   = DDirectory::pathToWindows($dest);
                }
                elseif(Yii::app()->user->isAdmin())
                    $result = shell_exec("echo ".Yii::app()->params['sudopwd']." | sudo -S  mv ".$src." ".$dest." 2>&1 &");
                else
                    $result = @rename($src, $dest);
                break;
            case 'upload':
                $this->uploadedFile=CUploadedFile::getInstance($this,'uploadedFile');
                $fileName = $this->oldName = $this->uploadedFile->name;
                // Check if file already exists?
                $filePathAndName = $this->path.'/'.basename($fileName);
                $i=0;
                $add = $i==0 ? '' : '.'.($i+1);
                while(is_file($filePathAndName.$add))
                    $add = '.'.(++$i+1);
                $result = $this->uploadedFile->saveAs($this->path.'/'.basename($fileName).$add);
                if($this->oldName!==basename($fileName).$add)
                    $this->name = basename($fileName).$add;
                break;
            case 'newdir':
                $newDir = $this->path.'/'.$this->p1;
                if(!is_dir($newDir))
                    $result = @mkdir($newDir, 0770);
                break;
        }
        return $result;
    }
    
 
}