<?php 
/**
 * DDMediaAction class file.
 * @author Joachim Werner <joachim.werner@diggin-data.de>
 * @copyright Copyright &copy; Joachim Werner 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package media.models
 */

/**
 * Form Model for managing directory/file actions.
 */
class DDMediaAction extends CFormModel
{
    // {{{ *** Members ***
    public $path;
    public $name;
    public $multipleNames;
    public $oldName;
    public $mediaType;
    public $action;
    public $p1;
    public $uploadedFile;
    // }}} 
    // {{{ rules
    public function rules()
    { 
        return array(
            array('path, mediaType, action','required'),
            array('action','checkActionParams'),
            array('name, multipleNames, oldName, p1', 'safe'),
            array('uploadedFile','file','on'=>'upload'),
        );
    } // }}}
    // {{{ checkActionParams
    public function checkActionParams($attribute, $params=array())
    {
        switch($this->action)
        {
            case 'rename':
                if(trim($this->p1)=='') {
                    $this->addError('p1', 'Please enter the new name');
                }
                break;
            case 'move':
                if(trim($this->p1)=='') {
                    $this->addError('p1', 'Please enter the destination');
                }
                break;
            case 'newdir':
                if(trim($this->p1)=='') {
                    $this->addError('p1', 'Please enter the new directory name');
                }
                break;
        }
    } // }}}
    // {{{ attributeLabels
    public function attributeLabels()
    {
        return array(
            'path'          => Yii::t('main','Path'),
            'name'          => Yii::t('main','Name'),
            'multipleNames' => Yii::t('main','Multiple Selection'),
            'oldName'       => Yii::t('main','Old Name'),
            'mediaType'     => Yii::t('main','Media Type'),
            'action'        => Yii::t('main','Action'),
            'p1'            => Yii::t('main','Parameter 1'),
            'uploadedFile'  => Yii::t('main','Upload File'),
        );
    } // }}}
    // {{{ doAction
    public function doAction()
    {
        $result = false;
        switch($this->action)
        {
            case 'rename':
                $src = $this->path;
                $dest = dirname($this->path).'/'.$this->p1;
                if($this->isWindows()) {
                    $src    = DDMediaDirectory::pathToWindows($src);
                    $dest   = DDMediaDirectory::pathToWindows($dest);
                }
                $result = @rename($src, $dest);
                break;
            case 'copy':
                $src = $this->path;
                $dest = $this->p1.'/'.$this->oldName;
                if($this->isWindows()) {
                    $src    = DDMediaDirectory::pathToWindows($src);
                    $dest   = DDMediaDirectory::pathToWindows($dest);
                }
                $result = $this->rcopy($src, $dest);
                break;
            case 'delete':
                $path = $this->path;
                if($this->isWindows()) {
                    $path    = DDMediaDirectory::pathToWindows($path);
                }
                //echo "<li>path: $path";
                if(is_file($this->path))
                    $result = @unlink($path);
                else
                    $result = DDMediaDirectory::rrmdir($path);
                break;
            case 'move':
                $src    = $this->path;
                $dest   = $dest = dirname($this->p1).'/'.$this->oldName;
                if($this->isWindows()) {
                    $src    = DDMediaDirectory::pathToWindows($src);
                    $dest   = DDMediaDirectory::pathToWindows($dest);
                }
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
    } // }}}
    // {{{ isWindows
    public function isWindows()
    {
        return strtoupper(substr(php_uname('s'), 0, 3)) === 'WIN';
    } // }}} 
    // removes files and non-empty directories
    public function rrmdir($dir) 
    {
        if (is_dir($dir)) {
            $files = @scandir($dir);
            foreach ($files as $file)
                if ($file != "." && $file != "..") $this->rrmdir("$dir/$file");
            @rmdir($dir);
        }
        else if (file_exists($dir)) @unlink($dir);
        return true;
    }
    
    // copies files and non-empty directories
    public function rcopy($src, $dst) 
    {
        if (file_exists($dst)) $this->rrmdir($dst);
        if (is_dir($src)) {
            @mkdir($dst);
            $files = @scandir($src);
            foreach ($files as $file)
                if ($file != "." && $file != "..") $this->rcopy("$src/$file", "$dst/$file"); 
        }
        else if (file_exists($src)) @copy($src, $dst);
        return true;
    }
}
