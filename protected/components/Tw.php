<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tw
 *
 * @author asdmundtultra
 */
class Tw {
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

}

?>
