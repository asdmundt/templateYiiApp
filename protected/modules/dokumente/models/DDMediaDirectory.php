<?php
/**
 * DDMediaDirectory class file.
 * @author Joachim Werner <joachim.werner@diggin-data.de>
 * @copyright Copyright &copy; Joachim Werner 2013-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package media.models
 * 
 * 
 * function resize($img, $thumb_width, $newfilename) 
{ 
  $max_width=$thumb_width;

    //Check if GD extension is loaded
    if (!extension_loaded('gd') && !extension_loaded('gd2')) 
    {
        trigger_error("GD is not loaded", E_USER_WARNING);
        return false;
    }

    //Get Image size info
    list($width_orig, $height_orig, $image_type) = getimagesize($img);
    
    switch ($image_type) 
    {
        case 1: $im = imagecreatefromgif($img); break;
        case 2: $im = imagecreatefromjpeg($img);  break;
        case 3: $im = imagecreatefrompng($img); break;
        default:  trigger_error('Unsupported filetype!', E_USER_WARNING);  break;
    }
    
  
    $aspect_ratio = (float) $height_orig / $width_orig;

 
    $thumb_height = round($thumb_width * $aspect_ratio);
    

    while($thumb_height>$max_width)
    {
        $thumb_width-=10;
        $thumb_height = round($thumb_width * $aspect_ratio);
    }
    
    $newImg = imagecreatetruecolor($thumb_width, $thumb_height);
    
   
    if(($image_type == 1) OR ($image_type==3))
    {
        imagealphablending($newImg, false);
        imagesavealpha($newImg,true);
        $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
        imagefilledrectangle($newImg, 0, 0, $thumb_width, $thumb_height, $transparent);
    }
    imagecopyresampled($newImg, $im, 0, 0, 0, 0, $thumb_width, $thumb_height, $width_orig, $height_orig);
    
    //Generate the file, and rename it to $newfilename
    switch ($image_type) 
    {
        case 1: imagegif($newImg,$newfilename); break;
        case 2: imagejpeg($newImg,$newfilename);  break;
        case 3: imagepng($newImg,$newfilename); break;
        default:  trigger_error('Failed resize image!', E_USER_WARNING);  break;
    }
 
    return $newfilename;
}

echo resize("test4.png", 120, "thumb_test4.png");
 * 
 * 
 * 
 * 
$file = "test.txt"; //FILEADDRESS
$size = "100"; //IMAGE SIZE
$data = file($file);
$im = @ imagecreate($size, $size) or die();
$bc = imagecolorallocate($im, 255, 255, 255);
$tc = imagecolorallocate($im, 0, 0, 0);
$lines = (int) $size / 10;
for ($t = 0; $t < $lines; $t++)
{
    imagestring($im, 3, 4, 4, $data[$t], $tc);
    imagestring($im, 3, 4, 4 + ($t * 10), $data[$t], $tc);
}
header("Content-type: image/png");
imagepng($im);
imagedestroy($im);
 */

/**
 * Model for managin directories.
 */
class DDMediaDirectory
{
    // {{{ *** Members ***
    public $dir;
    public $showHiddenFiles=false;
    private $_logTag='application.modules.media.models.DDmediaDirectory';
    // }}} 
    // {{{ *** Methods ***
    // {{{ __construct
    function __construct($dir=null)
    {
        if($dir!==null) {
            $this->dir = self::pathToUnix($dir);
            if(!is_dir($this->dir)) {
                throw new CHttpException(500, "{$this->dir} is not a directory");
            }
        }
    } // }}}
    // {{{ listContent
    public function listContent()
    {
        Yii::log("Directory: {$this->dir}", 'info', $this->_logTag);
        if ($handle == @opendir($this->dir)) {
            $dirs = $files = array();
            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                $entryPath = $this->dir.'/'.$entry;
                Yii::log("Entry: $entry", 'info', $this->_logTag);
                if(is_dir($entryPath)) {
                    $entryPathReal = $this->pathToUnix(realpath($entryPath));
                    // Directory
                    if(substr($entry,0,1)=='.' and !in_array($entry,array('.','..'))) {
                        if($this->showHiddenFiles==true)
                            $dirs[$entryPathReal] = $this->getMediaStats($entryPath);
                    } else {
                        $dirs[$entryPathReal] = $this->getMediaStats($entryPath);
                    }
                } else {
                    $file = new DDMediaFile($entryPath);
                    // File
                    // dot file/hidden?
                    if(substr($entry,0,1)=='.') {
                        if($this->showHiddenFiles==true)
                            $files[$entryPath] = $file->getMediaStats();
                    } else {
                        $files[$entryPath] = $file->getMediaStats();
                    }
                }
            }
            ksort($dirs);
            ksort($files);

            closedir($handle);
            return array('dirs'=>$dirs, 'files'=>$files);
        }

    } // }}}
    // {{{ getSubDirs
    public function getSubDirs($dir)
    {
        if ($handle == opendir($dir)) {
            $dirs =array();
            /* This is the correct way to loop over the directory. */
            while (false !== ($entry = readdir($handle))) {
                if($entry!=='.' and $entry !=='..' and is_dir($dir.'/'.$entry))
                    $dirs[] = $entry;
            }
            sort($dirs);
            return $dirs;
        }
    } // }}}
    // {{{ countItems
    public function countItems($dir)
    {
        Yii::log("Directory: {$dir}", 'info', $this->_logTag);
        if ($handle == @opendir($dir)) {
            $dirs = $files = array();
            /* This is the correct way to loop over the directory. */
            $count = 0;
            while (false !== ($entry = readdir($handle))) {
                // DEBUG echo "<li>$entry ";
                if(substr($entry,0,1)=='.' and !in_array($entry,array('.','..'))) {
                    if($this->showHiddenFiles==true)
                        $count++;
                } else {
                    if(!in_array($entry,array('.','..')))
                        $count++;
                }
                // DEBUG echo $count;
            }
            closedir($handle);
            return $count;
        }
    } // }}}
    // {{{ getMediaStats
    public function getMediaStats($entryPath)
    {
        return array(
            'type'=>'directory',
            'path'=>$entryPath,
            'name'=>basename($entryPath),
            'size'=>$this->countItems($entryPath),
            'mimeType'=>'',
            'mTime'=>'',
        );
    } // }}}
    // {{{ pathToUnix
    public function pathToUnix($dir)
    {
        return str_replace("\\", '/', $dir);
    } // }}} 
    // {{{ pathToWindows
    public function pathToWindows($dir)
    {
        return str_replace("/", "\\", $dir);
    } // }}} 
    // {{{ rrmdir
    /**
     *  recursively remove a directory
     */
    function rrmdir($dir) 
    {
        if (is_dir($dir)) { 
            $objects = scandir($dir); 
            foreach ($objects as $object) { 
                if ($object != "." && $object != "..") { 
                    if (filetype($dir."/".$object) == "dir") self::rrmdir($dir."/".$object); else unlink($dir."/".$object);
                } 
            } 
            reset($objects); 
            rmdir($dir); 
        } 
        return !is_dir($dir);
    } // }}} 
    // }}} End Methods
}
