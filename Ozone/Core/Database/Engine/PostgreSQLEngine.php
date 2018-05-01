<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 20.04.2018
 * Time: 10:07
 */

namespace Ozone\Core\Database\Engine;
use \PDO;


/**
 * Class PostgreSQLEngine
 * @version 0.0.1
 * @author Lukas Eßmann
 * @package Ozone\Core\Database\Engine
 */
class PostgreSQLEngine extends Engine
{

    /**
     * PostgreSQLEngine constructor.
     */
    public function __construct()
    {
    }

    /**
     * Connect to database.
     * @return mixed|void
     */
    public function connect()
    {
        try
        {
            $this->connection = new PDO("pgsql:host={$GLOBALS['Config']['database']['host']};dbname={$GLOBALS['Config']['database']['name']}", $GLOBALS['Config']['database']['username'], $GLOBALS['Config']['database']['password']);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $e)
        {
            //TODO: Handle PDOException
        }
    }

    /**
     * Disconnect from database.
     * @return mixed|void
     */
    public function close()
    {
        $this->connection = null;
    }
}