<?php
/**
 * Helper class
 * @author soehnke mundt asdmundt@gmail.com
 * @version string
 * @package application.components
 *
 */
class THelper extends CApplicationComponent
{ 
    /**
     *@var string date formatter string yyyy-mm-dd
     
     */
    public static $dateFormat = "d.m.Y H:i:s";  //"d.m.Y H:i:s" "dd.mm.yyyy"
    
    /**
     * @param string $date in form von yyyy-mm-dd
     * @return string in form von dd.mm.yyyy 
     */
    public static function date_mysqlToGerman($date) {
        $d    =    explode("-",$date);
        return    sprintf("%02d.%02d.%04d", $d[2], $d[1], $d[0]);
    }
     /**
     * @param string $date in form von dd.mm.yyyy
     * @return string in form von yyyy-mm-dd
     */
    public static function date_germanToMysql($date) {
        $d    =    explode(".",$date);
        return    sprintf("%04d-%02d-%02d", $d[2], $d[1], $d[0]);
    }
    
    /**
     * @param string $date in form von dd.mm.yyyy
     * @return string in form von yyyymmdd
     */
    public static function date_germanToInt($date) {
        $d    =    explode(".",$date);
        return    sprintf("%04d%02d%02d", $d[2], $d[1], $d[0]);
    }
    
     /**
     * @param string $date in form von dd.mm.yyyy
     * @return string in form von yyyy-mm-dd
     */
    public static function date_german2mysql($date) {
        $d    =    explode(".",$date);
        return    sprintf("%04d-%02d-%02d", $d[2], $d[1], $d[0]);
    }
    
    /**
     * formatiert aus einem timestamp Typ ein Deutsches Datums- Format
     * @param integer $date
     * @return string
     */
    public static function timestamp_mysql2german($date) {

        $stamp['date']    =    sprintf("%02d.%02d.%04d",
            substr($date, 6, 2),
            substr($date, 4, 2),
            substr($date, 0, 4));

        $stamp['time']    =    sprintf("%02d:%02d:%02d",
            substr($date, 8, 2),
            substr($date, 10, 2),
            substr($date, 12, 2));

        return $stamp;
    }
    
    /**
     * formatiert aus einem timestamp Typ ein Deutsches Datums- Format
     * @param integer $date
     * @return string
     */
    public static function timestamp_mysqltogerman($date) {

        $stamp['date']    =    sprintf("%02d.%02d.%04d",
            substr($date, 6, 2),
            substr($date, 4, 2),
            substr($date, 0, 4));

        $stamp['time']    =    sprintf("%02d:%02d:%02d",
            substr($date, 8, 2),
            substr($date, 10, 2),
            substr($date, 12, 2));

        return $stamp;
    }

    public static function intTomysql($date) {

       
        return sprintf("%02d-%02d-%04d",
               substr($date, 0, 4),
               substr($date, 4, 2),
               substr($date, 6, 2));
    }
    
          /**
     * generate from modules array @see config file
     * @return array of menu items
     */
    public function getMainMenu() {
        $dataArray = array();
        //$i = 0;
        $moduleNames = Yii::app()->metadata->getModules();
        
        foreach ($moduleNames as $i=>$moduleName) {
          $dataArray[$i][$name] =  Yii::t('app', $moduleName);
          $dataArray[$i][$icon] =  $moduleName.'png';
          $dataArray[$i][$url] =  Yii::t('app', $moduleName);
        }
        return    sprintf("%02d.%02d.%04d", $d[2], $d[1], $d[0]);
    }
    
            /**
     * generate from modules array @see config file
     * @return array of dashboard items
     */
    public function getStartArray() {
        $d    =    explode("-",$date);
        return    sprintf("%02d.%02d.%04d", $d[2], $d[1], $d[0]);
    }
    
   // public static function multiexplode 
    public static function getVersion()
    {
        return trim(file_get_contents(dirname(__FILE__) . '/../../version.txt'));
    }
}
?>
