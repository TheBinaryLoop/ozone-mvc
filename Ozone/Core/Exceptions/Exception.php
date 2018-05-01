<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 20.04.2018
 * Time: 14:41
 */

namespace Ozone\Core\Exceptions;


/**
 * Base Exception for Ozone
 * @version 0.0.1
 * @author Lukas Eßmann
 * @package Ozone\Core\Exceptions
 */
class Exception extends \Exception
{
    /**
     * Prettify error message output.
     * @return string
     */
    public function errorMessage()
    {
        return '<strong>' . htmlspecialchars($this->getMessage()) . "</strong><br />\n";
    }
}