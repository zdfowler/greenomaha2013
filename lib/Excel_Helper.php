<?php
class Excel_Helper {

    public static function exceltomysqldate($date,$format = "m/d/Y") {
    // This function converts a date from Excel Format to any php-format.
    // Used to compare MySQL dates.
    // Excel's format is : number of days since Jan 1 1900.
    // Time can be used as a decimal, but not used here.
    if ($date == '') {
        return '';
    }
    $days = floor($date);
    $date = mktime(0,0,0,1,-1+$days,1900);
        return date($format,$date);
    }

}