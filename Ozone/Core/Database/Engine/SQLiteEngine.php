<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 20.04.2018
 * Time: 16:46
 */

namespace Ozone\Core\Database\Engine;


/**
 * Class SQLiteEngine
 * @version 0.0.1
 * @author Lukas Eßmann
 * @package Ozone\Core\Database\Engine
 */
class SQLiteEngine extends Engine
{
    /**
     * IEngine constructor.
     */
    public function __construct()
    {
    }

    /**
     * Connect to database.
     * @return mixed
     */
    public function connect()
    {
        // TODO: Implement connect() method.
    }

    /**
     * Disconnect from database.
     * @return mixed
     */
    public function close()
    {
        // TODO: Implement close() method.
    }
}