<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 15.04.2018
 * Time: 13:32
 */

namespace Ozone\Core\Database\Engine;


/**
 * Base Database Engine
 * @version 0.0.1
 * @author Lukas Eßmann
 * @package Ozone\Core\Database\Engine
 */
abstract class Engine implements IEngine
{
    /**
     * The PDO connection object
     * @var PDO
     */
    protected $connection;
}