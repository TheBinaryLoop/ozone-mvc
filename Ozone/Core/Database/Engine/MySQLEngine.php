<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 20.04.2018
 * Time: 09:48
 */

namespace Ozone\Core\Database\Engine;
use Ozone\Core\Config;
use \PDO;


/**
 * Class MySQLEngine
 * @package Ozone\Core\Database\Engine
 */
class MySQLEngine extends Engine
{
    /**
     * MySQLEngine constructor.
     */
    public function __construct()
    {
    }

    /**
     * Connect to database.
     */
    public function connect()
    {
        try
        {
            $this->connection = new PDO("mysql:host=".Config::getInstance()->get('database.host').";dbname=".Config::getInstance()->get('database.name'), Config::getInstance()->get('database.username'), Config::getInstance()->get('database.password'));
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (\PDOException $e)
        {
            //TODO: Handle PDOException
        }
    }

    /**
     * Disconnect from database.
     */
    public function close()
    {
        $this->connection = null;
    }
}