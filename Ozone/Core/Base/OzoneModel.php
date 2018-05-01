<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 24.04.2018
 * Time: 09:29
 */

namespace Ozone\Core\Base;


/**
 * The base model for Ozone
 *
 * @author Lukas Eßmann
 * @package Ozone\Core\Base
 */
class OzoneModel extends \Model
{
    public function __construct()
    {
        /* Set up the database connection */
        $db_config = $GLOBALS['Config']['database'];
        switch ($db_config['type'])
        {
            case 'mysql':
                \ORM::setDb(new \PDO("mysql:host={$db_config['host']};port={$db_config['port']};dbname={$db_config['dbname']};charset=utf8", $db_config['username'], $db_config['password']));
                break;
            case 'sqlite':
                \ORM::setDb(new \PDO("sqlite:{$db_config['path']}", null, null));
                break;
            case 'sqlite2':
                \ORM::setDb(new \PDO("sqlite2:{$db_config['path']}", null, null));
                break;
            case 'firebird':
                if (isset($db_config['host']) && !empty($db_config['host']) && isset($db_config['port']) && !empty($db_config['port']))
                {
                    \ORM::setDb(new \PDO("firebird:dbname={$db_config['host']}/{$db_config['port']}:{$db_config['path']}", $db_config['username'], $db_config['password']));
                    break;
                } elseif (isset($db_config['host']) && !empty($db_config['host']) && $db_config['host'] === 'localhost')
                {
                    \ORM::setDb(new \PDO("firebird:dbname=localhost:{$db_config['path']}", $db_config['username'], $db_config['password']));
                    break;
                } elseif (isset($db_config['path']) && !empty($db_config['path']))
                {
                    \ORM::setDb(new \PDO("firebird:dbname={$db_config['path']}", $db_config['username'], $db_config['password']));
                    break;
                } else {
                    //TODO: Throw error
                }
                break;
            case 'pgsql':
                \ORM::setDb(new \PDO("pgsql:host={$db_config['host']};port={$db_config['port']};dbname={$db_config['dbname']};user={$db_config['username']};password={$db_config['password']}"));
                break;
            default:
                //TODO: Throw error
                break;
        }
    }
}