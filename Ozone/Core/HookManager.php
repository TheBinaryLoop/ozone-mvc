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
    private static $instance;

    private $hooks;

    /**
     * Check if $this->hooks isset and is array
     */
    private function __construct()
    {
        $this->hooks = array();
        /*if ( !isset( $GLOBALS['hook'] ))
        {
            throw new \UnexpectedValueException('$GLOBALS[\'hook\'] can\'t be null');
        }
        if ( !is_array( $this->hooks ) )
        {
            throw new \TypeError('$GLOBALS[\'hook\'] must be of type array');
        }*/
        return;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new HookManager();
        }
        return self::$instance;
    }

    private function __clone(){ }

    private function __wakeup() { }

    /**
     * Save hook function in $this->hooks
     * @param string $channel
     * @param callable $func
     */
    public function watch($channel, callable $func){

        if( !isset( $this->hooks[$channel] ) ){

            $this->hooks[$channel] = array();

        }

        array_push($this->hooks[$channel], $func);

    }

    /**
     * Loop through $this->hooks and call hook functions
     * @param string $channel
     * @param array $vars
     * @return mixed
     */
    public function subscribe($channel, $vars = array()){

        if( isset( $this->hooks[$channel] ) ){

            foreach( $this->hooks[$channel] as $func ){

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