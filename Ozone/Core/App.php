<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 14.04.2018
 * Time: 12:58
 */

namespace Ozone\Core;

use Noodlehaus\Config;
use Noodlehaus\Exception\EmptyDirectoryException;

/**
 * Ozone Framework
 * @name App
 * @version 0.0.4
 * @author Lukas Eßmann
 * @package Ozone\Core
 */
class App
{
    /* Properties */

    /**
     * The bootstrapper
     * @var Bootstrap
     */
    private $bootstrap;

    /**
     * The logging manager
     * @var Logger
     */
    private $logger;

    /* Methods */
    /**
     * App constructor.
     */
    public function __construct()
    {
        // Instantiating the Logger
        $this->createLogger();
        // Instantiating the HookManager
        $this->createHookManager();
        // Loading the config file
        $this->loadConfig(__DIR__ . '/../Config/default.php');
        // Create Database Proxy
        //$GLOBALS['DB'] = new DatabaseProxy();
        // Create the bootstrapper
        $this->bootstrap = new Bootstrap();
    }

    /**
     * Starts the processing of the request.
     */
    public function bootstrap()
    {
        // TODO: Implement
        $this->bootstrap->parseRequest();
        $controller = $this->bootstrap->createController();
        if ($controller)
            $controller->executeAction();
    }

    /**
     * Creates a new instance of the Logger class and makes it global.
     */
    private function createLogger()
    {
        $GLOBALS['Logger'] = new Logger();
        $this->logger = $GLOBALS['Logger'];
    }

    /**
     * Tries to load the passed config file.
     * @param string $configFilePath
     * @throws \InvalidArgumentException
     */
    public function loadConfig(string $configFilePath)
    {
        if ($configFilePath == "")
            throw new \InvalidArgumentException('$configFilePath can\'t be null or empty!');
        try {
            $GLOBALS['Config'] = new Config($configFilePath);
        } catch (EmptyDirectoryException $e) {
            echo 'Error while loading config file: \r\n' . $e->getTraceAsString();
        }
    }

    /**
     *  Creates a new instance of the HookManager class and makes it global.
     */
    private function createHookManager()
    {
        $GLOBALS['hook'] = array();
        $GLOBALS['HookManager'] = new HookManager();
        //$this->logger->debug(__FILE__, "Created HookManager.");
    }

}