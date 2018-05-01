<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 15.04.2018
 * Time: 13:32
 */

namespace Ozone\Core\Database\Engine;


/**
 * Interface IEngine
 * @version 0.0.1
 * @author Lukas Eßmann
 * @package Ozone\Core\Database\Engine
 */
interface IEngine
{
    /**
     * IEngine constructor.
     */
    public function __construct();

    /**
     * Connect to database.
     * @return mixed
     */
    public function connect();

    /**
     * Disconnect from database.
     * @return mixed
     */
    public function close();
}