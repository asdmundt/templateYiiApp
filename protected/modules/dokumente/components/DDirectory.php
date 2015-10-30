<?php

/** Create an image gallery using only HTML and CSS.

  Simple Usage:

  echo DirectoryRendering::read("images/partners","simplest");

  "image/partners" is a sample directory, containing a set of images,
  and "simplest" is a style name used to render it.

  You can create your own styles in the array returned by getStyles() method.

  @author:  Söhnke Mundt asdmundt@gmail.com
 */
class DDirectory {

    private static $prefix = 'dir-';
    private static $_logTag = 'fileOperation';

    /** create a multi-dimensional array

      @example

      Usage:

      echo DirectoryRendering::getArray("images/partners");


      @param $imagesDirectory a image directory, example: "images/myphotos"
      @param $useStyleName a predefined style name, see also: getStyles, it must match an key array defined here.
      @return HTML TAG, example: <DIV><img>...<img>...</DIV>
     */
    public static function _getArray($directory, $wFile = FALSE) {
        $contents = array();
        $descendants = array();
        $i = 0;
        $mimeType = "";
        if ($directory[strlen($directory) - 1] != '/')
            $directory .= '/';
        Yii::log('DirectoryRendering:getArray:$directory= ' . $directory, 'info', 'dokumente');
        //$directory == '/' ? '' : $directory;
        Yii::log('DirectoryRendering:getArray:$directory= ' . $directory, 'info', 'dokumente');
        //$directory = substr($path,$position); 
        if ($dh = @opendir($directory)) {
            while (false !== ($item = readdir($dh))) {


                if (!in_array($item, array(".", "..", ""))) {
                    $path = $directory . $item;
                    $path_parts = pathinfo($path);
                    Yii::log('DirectoryRendering:getArray:$contents[$key]= ' . $path, 'info', 'dokumente');
                    //$myfile = Yii::app()->file->set($path, true);
                    Yii::log('DirectoryRendering:getArray:$myfile->size= ' . filesize($path), 'info', 'dokumente');
                    if (DDirectory::my_is_dir($path))
                        $mimeType = "folder";
                    else
                        $mimeType = preg_replace('/^.*\./', '', $path);


                    $descendants[] = array(
                        "id" => $i,
                        "name" => $item,
                        "path" => $path,
                        "mimeType" => $mimeType,
                        "size" => filesize($path),
                        "directory" => $directory,
                        "modified" => date("d.m.Y H:i:s", filemtime($path)),
                        "permissions" => fileperms($path),
                    );


                    $i++;
                }
            }
        } else {
            throw new CHttpException(500, 'Unable to get directory contents for "' . $directory . DIRECTORY_SEPARATOR . '"');
            return false;
        }
        return $descendants;
    }

    /** create a multi-dimensional array

      @example

      Usage:

      echo DirectoryRendering::getArray("images/partners");


      @param $imagesDirectory a image directory, example: "images/myphotos"
      @param $useStyleName a predefined style name, see also: getStyles, it must match an key array defined here.
      @return HTML TAG, example: <DIV><img>...<img>...</DIV>
     */
    public static function getArray($directory, $wFile = FALSE) {
        $output = array();
        $output_str = "";

        $descendants = array();
        $j = 0;
        $mimeType = "";
        if ($directory[strlen($directory) - 1] != '/')
            $directory .= '/';
        if (Yii::app()->getModule('dokumente')->debug)
            Yii::log('DirectoryRendering:getArray:$directory= ' . $directory, 'info', 'dokumente');
        //if (Yii::app()->user->isAdmin())
            //$output_str = shell_exec("echo " . Yii::app()->params['sudopwd'] . " | sudo -S  ls -la --time-style=+%d.%m.%Y-%T " . $directory . " 2>&1 &");
        //else
            $output_str = shell_exec("ls -la --time-style=+%d.%m.%Y-%T " . $directory . " 2>&1 ");
          
        $output = explode("\n", $output_str);

        for ($i = 2; $i < count($output) - 1; $i++) {

            if ($line_item = preg_split("/[\s]+/", $output[$i])) {
                $item = $line_item[6];
                $path = $directory . $item;
            $fileobj = Yii::app()->file->set($path,true);
            
                if (substr($line_item[0], 0, 1) == 'd') {
                    $mimeType = "folder";
                } else {
                    $mimeType = preg_replace('/^.*\./', '', $item);
                }
                $descendants[] = array(
                    "id" => $j,
                    "name" => $item,
                    "path" => $path,
                    "mimeType" => $mimeType,
                    "size" =>$line_item[4] ,//$fileobj->getSize('0.00'),$line_item[4]
                    "directory" => $directory,
                    "modified" => $line_item[5],
                    "uid" => $line_item[2],
                    "gid" => $line_item[3],
                    "permissions" =>$fileobj->getPermissions() ,//$line_item[0],
                );
                $j++;
            }
        }

        return $descendants;
    }
    
       /** create a multi-dimensional array

      @example

      Usage:

      echo DirectoryRendering::getArray("images/partners");


      @param $imagesDirectory a image directory, example: "images/myphotos"
      @param $useStyleName a predefined style name, see also: getStyles, it must match an key array defined here.
      @return HTML TAG, example: <DIV><img>...<img>...</DIV>
     */
    public static function getAdminArray($directory, $wFile = FALSE) {
        $output = array();
        $output_str = "";

        $descendants = array();
        $j = 0;
        $mimeType = "";
        if ($directory[strlen($directory) - 1] != '/')
            $directory .= '/';
        if (Yii::app()->getModule('dokumente')->debug)
            Yii::log('DirectoryRendering:getArray:$directory= ' . $directory, 'info', 'dokumente');
        //if (Yii::app()->user->isAdmin())
            $output_str = shell_exec('echo "saino1972" | sudo -S  ls -la --time-style=+%d.%m.%Y-%T ' . $directory . ' 2>&1 &');
            //$output_str = shell_exec('echo "saino1972" | sudo -S  ls -la --time-style=+%d.%m.%Y-%T / 2>&1 &');
            // else www-data   ALL = (ALL)        NOPASSWD: ALL
            //$output_str = shell_exec("ls -la --time-style=+%d.%m.%Y-%T " . $directory . " 2>&1 &");

        $output = explode("\n", $output_str);

        for ($i = 2; $i < count($output) - 1; $i++) {

            if ($line_item = preg_split("/[\s]+/", $output[$i])) {
                $item = $line_item[6];
                $path = $directory . $item;
            $fileobj = Yii::app()->file->set($path,true);

                if (substr($line_item[0], 0, 1) == 'd') {
                    $mimeType = "folder";
                } else {
                    $mimeType = preg_replace('/^.*\./', '', $item);
                }
                $descendants[] = array(
                    "id" => $j,
                    "name" => $item,
                    "path" => $path,
                    "mimeType" => $mimeType,
                    "size" => $line_item[4],
                    "directory" => $directory,
                    "modified" => $line_item[5],
                    "uid" => $line_item[2],
                    "gid" => $line_item[3],
                     "permissions" =>$fileobj->getPermissions(),
                );
                $j++;
            }
        }

        return $descendants;
    }

        public static function getWinArray($directory) {
        $contents = array();
        $descendants = array();
        $i = 0;
        $mimeType = "";
        if ($directory[strlen($directory) - 1] != DIRECTORY_SEPARATOR)
            $directory .= DIRECTORY_SEPARATOR;
        Yii::log('DirectoryRendering:getArray:$directory= ' . $directory, 'info', 'application');
        //$directory == '/' ? '' : $directory;
        Yii::log('DirectoryRendering:getArray:$directory= ' . $directory, 'info', 'application');
        //$directory = substr($path,$position); 
        if ($dh = @opendir($directory)) {
            while (false !== ($item = readdir($dh))) {


                if (!in_array($item, array(".", "..", ""))) {
                    $path = $directory . $item;
                    $path_parts = pathinfo($path);
                    Yii::log('DirectoryRendering:getArray:$contents[$key]= ' . $path, 'info', 'application');
                    //$myfile = Yii::app()->file->set($path, true);
                    Yii::log('DirectoryRendering:getArray:$myfile->size= ' . filesize($path), 'info', 'application');
                    if (DirectoryRendering::my_is_dir($path))
                        $mimeType = "folder";
                    else
                        $mimeType = preg_replace('/^.*\./', '', $path);


                    $descendants[] = array(
                        "id" => $i,
                        "name" => $item,
                        "path" => $path,
                        "mimeType" => $mimeType,
                        "size" => filesize($path),
                        "directory" => $directory,
                        "modified" => date("d.m.Y H:i:s", filemtime($path)),
                        "permissions" => fileperms($path),
                    );


                    $i++;
                }
            }
        } else {
            throw new CHttpException(500, 'Unable to get directory contents for "' . $directory . DIRECTORY_SEPARATOR . '"');
            return false;
        }
        return $descendants;
    }

    public static function my_is_dir($dir) {
        $output = shell_exec("echo " . Yii::app()->params['sudopwd'] . " | sudo -S  ls -dl " . $dir . " 2>&1 &");

        $line = array();
        for ($i = 0; $i <= count($output); $i++) {
            if ($line = explode("  ", $output[$i])) {
                if (substr($line[0], 0, 1) == '-') {
                    return FALSE;
                }
            }
        }
        return true;
    }

    /**
     * @name getSizeFormatted
     * 
     * @param integer $a_bytes the filesize
     * @author Söhnke Mundt 
     * @access	public
     * @return	string size of file + the size type e.g. MiB
     * 
     */
    public static function getSizeFormatted($a_bytes) {
        if ($a_bytes < 1024) {
            return $a_bytes . ' B';
        } elseif ($a_bytes < 1048576) {
            return round($a_bytes / 1024, 2) . ' KiB';
        } elseif ($a_bytes < 1073741824) {
            return round($a_bytes / 1048576, 2) . ' MiB';
        } elseif ($a_bytes < 1099511627776) {
            return round($a_bytes / 1073741824, 2) . ' GiB';
        } elseif ($a_bytes < 1125899906842624) {
            return round($a_bytes / 1099511627776, 2) . ' TiB';
        } elseif ($a_bytes < 1152921504606846976) {
            return round($a_bytes / 1125899906842624, 2) . ' PiB';
        } elseif ($a_bytes < 1180591620717411303424) {
            return round($a_bytes / 1152921504606846976, 2) . ' EiB';
        } elseif ($a_bytes < 1208925819614629174706176) {
            return round($a_bytes / 1180591620717411303424, 2) . ' ZiB';
        } else {
            return round($a_bytes / 1208925819614629174706176, 2) . ' YiB';
        }
    }

    /**
     * @name pathToUnix
     * 
     * @param path, example: "/images/myphotos"
     * @author Söhnke Mundt 
     * @access	public
     * @return	string formatted for linux
     * 
     */
    public static function pathToUnix($dir) {
        return str_replace("\\", '/', $dir);
    }

    /**
     * @name pathToWindows
     * 
     * @param path, example: "\images\myphotos"
     * @author Söhnke Mundt 
     * @access	public
     * @return	string formatted for windows
     * 
     */
    public static function pathToWindows($dir) {
        return str_replace("/", "\\", $dir);
    }

}