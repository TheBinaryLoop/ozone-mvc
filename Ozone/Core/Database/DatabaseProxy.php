<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 20.04.2018
 * Time: 09:13
 */

namespace Ozone\Core\Database;


use Ozone\Core\Config;
use Ozone\Core\Database\Engine\ElasticsearchEngine;
use Ozone\Core\Database\Engine\Engine;
use Ozone\Core\Database\Engine\FirebirdEngine;
use Ozone\Core\Database\Engine\MongoDBEngine;
use Ozone\Core\Database\Engine\MSSQLEngine;
use Ozone\Core\Database\Engine\MySQLEngine;
use Ozone\Core\Database\Engine\OracleEngine;
use Ozone\Core\Database\Engine\PostgreSQLEngine;
use Ozone\Core\Database\Engine\SimpleDBEngine;
use Ozone\Core\Database\Engine\SQLiteEngine;

/**
 * Class DatabaseProxy
 * @version 0.0.1
 * @author Lukas Eßmann
 * @package Ozone\Core\Database
 */
class DatabaseProxy extends Engine
{
    /**
     * Instance of the database engine
     * @var mixed
     */
    private $engine;

    /**
     * DatabaseProxy constructor.
     */
    public function __construct()
    {
        switch (Config::getInstance()->get('database.type')) {
            case 'ozone.db.dummy':
                {
                    // TODO: Create Dummy Engine
                    $GLOBALS['Logger']->debug(__FILE__, "Created Database Engine ".Config::getInstance()->get('database.type'));
                    break;
                }
            case 'ozone.db.mysql':
                {
                    // TODO: Create MySQL Engine
                    $this->engine = new MySQLEngine();
                    $GLOBALS['Logger']->debug(__FILE__, "Created Database Engine ".Config::getInstance()->get('database.type'));
                    break;
                }
            case 'ozone.db.postgresql':
                {
                    // TODO: Create PostgreSQL Engine
                    $this->engine = new PostgreSQLEngine();
                    $GLOBALS['Logger']->debug(__FILE__, "Created Database Engine ".Config::getInstance()->get('database.type'));
                    break;
                }
            case 'ozone.db.sqlite':
                {
                    // TODO: Create SQLite Engine
                    $this->engine = new SQLiteEngine();
                    $GLOBALS['Logger']->debug(__FILE__, "Created Database Engine ".Config::getInstance()->get('database.type'));
                    break;
                }
            case 'ozone.db.mssql':
                {
                    // TODO: Create MSSQL Engine
                    $this->engine = new MSSQLEngine();
                    $GLOBALS['Logger']->debug(__FILE__, "Created Database Engine ".Config::getInstance()->get('database.type'));
                    break;
                }
            case 'ozone.db.oracle':
                {
                    // TODO: Create Oracle Engine
                    $this->engine = new OracleEngine();
                    $GLOBALS['Logger']->debug(__FILE__, "Created Database Engine ".Config::getInstance()->get('database.type'));
                    break;
                }
            case 'ozone.db.firebird':
                {
                    // TODO: Create Firebird Engine
                    $this->engine = new FirebirdEngine();
                    $GLOBALS['Logger']->debug(__FILE__, "Created Database Engine ".Config::getInstance()->get('database.type'));
                    break;
                }
            case 'ozone.db.simpledb':
                {
                    // TODO: Create SimpleDB Engine
                    $this->engine = new SimpleDBEngine();
                    $GLOBALS['Logger']->debug(__FILE__, "Created Database Engine ".Config::getInstance()->get('database.type'));
                    break;
                }
            case 'ozone.db.elasticsearch':
                {
                    // TODO: Create Elasticsearch Engine
                    $this->engine = new ElasticsearchEngine();
                    $GLOBALS['Logger']->debug(__FILE__, "Created Database Engine ".Config::getInstance()->get('database.type'));
                    break;
                }
            case 'ozone.db.mongodb':
                {
                    // TODO: Create MongoDB Engine
                    $this->engine = new MongoDBEngine();
                    $GLOBALS['Logger']->debug(__FILE__, "Created Database Engine ".Config::getInstance()->get('database.type'));
                    break;
                }
            default:
                {
                    echo 'Could not create Database Engine ' . Config::getInstance()->get('database.type');
                    break;
                }
        }
    }

    /**
     * Connect to database.
     */
    public function connect()
    {
        $this->engine->connect();
    }

    /**
     * Disconnect from database.
     */
    public function close()
    {
        $this->engine->close();
    }
}