<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 14.04.2018
 * Time: 14:47
 */

namespace Ozone\Core;


/**
 * A Hook Manager
 * @version 0.0.2
 * @author Lukas Eßmann
 * @package Ozone\Core
 */
class HookManager
{
    /**
     * Check if $GLOBALS['hook'] isset and is array
     */
    public function __construct()
    {
        if ( !isset( $GLOBALS['hook'] ))
        {
            throw new \UnexpectedValueException('$GLOBALS[\'hook\'] can\'t be null');
        }
        if ( !is_array( $GLOBALS['hook'] ) )
        {
            throw new \TypeError('$GLOBALS[\'hook\'] must be of type array');
        }
        return;
    }

    /**
     * Save hook function in $GLOBALS['hook']
     * @param string $channel
     * @param callable $func
     */
    public function watch($channel, callable $func){

        if( !isset( $GLOBALS['hook'][$channel] ) ){

            $GLOBALS['hook'][$channel] = array();

        }

        array_push($GLOBALS['hook'][$channel], $func);

    }

    /**
     * Loop through $GLOBALS['hook'] and call hook functions
     * @param string $channel
     * @param array $vars
     * @return mixed
     */
    public function subscribe($channel, $vars = array()){

        if( isset( $GLOBALS['hook'][$channel] ) ){

            foreach( $GLOBALS['hook'][$channel] as $func ){

                if ($vars !== null) {
                    return call_user_func($func, $vars);
                } else {
                    return call_user_func($func);
                }

            }

        }
        return null;
    }
}