<?php

/** Create an image gallery using only HTML and CSS.

  Simple Usage:

  echo DirectoryRendering::read("images/partners","simplest");

  "image/partners" is a sample directory, containing a set of images,
  and "simplest" is a style name used to render it.

  You can create your own styles in the array returned by getStyles() method.

  @author:  Christian Salazar christiansalazarh@gmail.com
 */
class DirectoryRendering {

    private static $prefix = 'dir-';

    /** display a photo gallery.

      @example

      Usage:

      echo DirectoryRendering::read("images/partners","simplest");


      @param $imagesDirectory a image directory, example: "images/myphotos"
      @param $useStyleName a predefined style name, see also: getStyles, it must match an key array defined here.
      @return HTML TAG, example: <DIV><img>...<img>...</DIV>
     */
    public static function read($imagesDirectory, $useStyleName = null) {
        $classtag = "";
        $r = "";

        $styles = self::getStyles();
        $prefix = self::$prefix;

        if ($useStyleName != null) {
            if (isset($styles[$useStyleName])) {
                $r .= $styles[$useStyleName];
                $classtag = "class='{$prefix}{$useStyleName}'";
            }
        }
        $r .= "<div {$classtag}>";
        foreach (scandir($imagesDirectory) as $f)
            if (!is_dir($f))
                $r .= "<img src='{$imagesDirectory}/{$f}'>";
        $r .= "</div>";
        return $r;
    }

    /** create a multi-dimensional array

      @example

      Usage:

      echo DirectoryRendering::getArray("images/partners");


      @param $directory a directory, example: "images/myphotos"
      @param $wFile a predefined style name, see also: getStyles, it must match an key array defined here.
      @return array
     */
    public static function getArray($directory, $wFile = FALSE) {
        $contents = array();
        $descendants = array();
        $i = 0;
        $mimeType = "";
        if ($directory[strlen($directory) - 1] != '/')
            $directory .= '/';
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

        $mimeType = "";
        if ($directory[strlen($directory) - 1] != '/')
            $directory .= '/';
        Yii::log('DirectoryRendering:getArray:$directory= ' . $directory, 'info', 'application');
        $output_str = shell_exec("echo " . Yii::app()->params['sudopwd'] . " | sudo -S  ls -la --time-style=+%d.%m.%Y-%T " . $directory . " 2>&1 &");
        Yii::log('DirectoryRendering:getAdminArray:$output_str= ' . $output_str, 'info', 'application');

        $output = explode("\n", $output_str);

        for ($i = 2; $i < count($output) - 1; $i++) {

            if ($line_item = preg_split("/[\s]+/", $output[$i])) {
                $item = $line_item[6];
                $path = $directory . $item;
                Yii::log('DirectoryRendering:getArray:$path= ' . $path, 'info', 'application');
                Yii::log('DirectoryRendering:getArray:substr($line_item[0], 0, 1)= ' . substr($line_item[0], 0, 1), 'info', 'application');
                if (substr($line_item[0], 0, 1) == 'd') {
                    $mimeType = "folder";
                } else {
                    $mimeType = preg_replace('/^.*\./', '', $item);
                }
                $descendants[] = array(
                    "id" => $i,
                    "name" => $item,
                    "path" => $path,
                    "mimeType" => $mimeType,
                    "size" => $line_item[4],
                    "directory" => $directory,
                    "modified" => $line_item[5],
                    "permissions" => $line_item[0],
                );
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
    public static function getDirs($directory) {
        $files = array();
        $i = 0;
        $myfile = Yii::app()->file->set($path, true);
        return $files;
    }

    /**  Availabe style names:	"simplest"
     */
    private static
            function getStyles() {
        return array(
            "simplest" =>
            "<style>
				div.imagegallery-simplest{
					margin: 0px;
					padding: 0px;
					overflow: auto;
					text-align: center;
				}
				div.imagegallery-simplest img{
					max-width: 150px;
					margin: 30px;
				}
			</style>",
        );
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

}
