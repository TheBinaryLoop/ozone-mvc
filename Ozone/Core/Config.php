<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 01.05.2018
 * Time: 16:23
 */

namespace Ozone\Core;

use Noodlehaus\Config as Conf;
use Noodlehaus\Exception\EmptyDirectoryException;


class Config
{
    private static $instance;
    private $config;

    private function __construct($path)
    {
        if ($path == "")
            throw new \InvalidArgumentException('$path can\'t be null or empty!');
        try {
            $this->config = new Conf($path);
        } catch (EmptyDirectoryException $e) {
            echo 'Error while loading config file: \r\n' . $e->getTraceAsString();
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Config($GLOBALS['CONFIG_PATH']);
        }
        return self::$instance;
    }

    public function get($key, $default = null)
    {
        return $this->config->get($key, $default);
    }

    public function set($key, $value)
    {
        $this->config->set($key, $value);
    }

    public function has($key)
    {
        return $this->config->has($key);
    }

    public function getConfig()
    {
        return $this->config;
    }

    private function __clone(){ }

    private function __wakeup() { }

}