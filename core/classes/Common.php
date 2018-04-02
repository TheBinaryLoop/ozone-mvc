<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 21.02.2018
 * Time: 17:39
 */

namespace core\classes;

class Common
{
    static function auto_copyright($year = 'auto')
    {
        if (intval($year) == 'auto') {
            $year = date('Y');
        }
        if (intval($year) == date('Y')) {
            echo intval($year);
        }
        if (intval($year) < date('Y')) {
            echo intval($year) . ' - ' . date('Y');
        }
        if (intval($year) > date('Y')) {
            echo date('Y');
        }
    }

}