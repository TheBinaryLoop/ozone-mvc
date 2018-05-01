<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 14.04.2018
 * Time: 13:49
 */

namespace Ozone\Core;

use Ozone\App\Controllers\AppController;
use Ozone\Core\Helpers\URLHelper;
use ReflectionClass;
use ReflectionException;

/**
 * The bootstrapper
 * @version 0.0.4
 * @author Lukas Eßmann
 * @package Ozone\Core
 */
class Bootstrap
{
    /* Variables */
    /**
     * The resulting controller.
     * @var AppController
     */
    private $controller;

    /**
     * The resulting action.
     * @var string
     */
    private $action;
    /**
     * The whole request.
     * @var array
     */
    private $request;

    /* Functions */
    /**
     * Bootstrap constructor.
     */
    public function __construct()
    {
        $this->request = array();
    }

    /**
     * Parse the request and sets the $controller and $action properties.
     * @see Bootstrap::$controller
     * @see Bootstrap::$action
     */
    public function parseRequest()
    {
        $this->request['controller'] = ucfirst(URLHelper::part(1));
        $this->request['action'] = URLHelper::part(2);

        $result = HookManager::getInstance()->subscribe('preParseRequest', $this->request);
        if (!is_null($result) && is_array($result))
            $this->request = $result;

        if ($this->request['controller'] == '')
            $this->controller = 'Ozone\\App\\Controllers\\'.Config::getInstance()->get('defaults.controller');
        else
            $this->controller = 'Ozone\\App\\Controllers\\'.$this->request['controller'];

        if ($this->request['action'] == '')
            $this->action = Config::getInstance()->get('defaults.action');
        else
            $this->action = $this->request['action'];

        $result = HookManager::getInstance()->subscribe('postParseRequest', $this->request);
        if (!is_null($result) && is_array($result))
            $this->request = $result;
    }

    /**
     * Creates a new controller from the request
     * @return object|AppController The requested controller
     */
    public function createController()
    {
        $result = HookManager::getInstance()->subscribe('preCreateController', $this->controller);
        if (!is_null($result))
            $this->controller = $result;

        // Check class
        if (class_exists($this->controller))
        {
            $reflectionClass = null;
            try {
                $reflectionClass = new ReflectionClass($this->controller);
            } catch (ReflectionException $e) {
                //TODO: Handle Error
            }
            // Check extend
            if ($reflectionClass->getParentClass()->getShortName() === 'AppController')
            {
                if ($reflectionClass->hasMethod($this->action))
                {
                    return $reflectionClass->newInstanceArgs([$this->action, $this->request]);
                } else {
                    // Method does not exist
                    header('HTTP/1.1 404 Not Found');
                    $GLOBALS['Logger']->error(__FILE__, "User requested method '{$this->action}' in controller '{$this->controller}' which does not exist.");
                    echo "<h1>Method '{$this->action}' does not exist</h1>";
                    return null;
                }
            }
        } else {
            // Controller not found
            header('HTTP/1.1 404 Not Found');
            $GLOBALS['Logger']->error(__FILE__, "User requested controller '{$this->controller}' which does not exist.");
            echo "<h1>{$this->controller} controller not found</h1>";
            return null;
        }
        return null;
    }
}