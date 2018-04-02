<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 09.03.2018
 * Time: 17:02
 */

namespace core\classes;

class HookManager
{
    /**
     * check if $GLOBALS['hook'] isset and is array
     */
    public function __construct()
    {
        if( !isset( $GLOBALS['hook'] ) && !is_array( $GLOBALS['hook'] ) )
        {
            return;
        }
    }

    /**
     * save hook function in $GLOBALS['hook']
     * @param String, function
     */
    public function watch($channel, $func){

        if( !isset( $GLOBALS['hook'][$channel] ) ){

            $GLOBALS['hook'][$channel] = array();

        }

        array_push($GLOBALS['hook'][$channel], $func);

    }

    /**
     * loop through $GLOBALS['hook'] and call hook functions
     * @param String
     * @param mixed | null
     * @return mixed | null
     */
    public function subscribe($channel, $vars = null){

        if( isset( $GLOBALS['hook'][$channel] ) ){

            foreach( $GLOBALS['hook'][$channel] as $func ){

                if ($vars !== null) {
                    return $func($vars);
                } else {
                    return $func();
                }

            }

        }
        return null;
    }
}