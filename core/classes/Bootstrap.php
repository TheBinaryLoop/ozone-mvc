<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 21.02.2018
 * Time: 11:54
 */

namespace core\classes;

class Bootstrap
{
    private $controller;
    private $action;
    private $request;

    public function __construct()
    {
        $this->request = array();
    }

    public function parseRequest()
    {
        $this->request['controller'] = \core\classes\URL::part(1);
        $this->request['action'] = \core\classes\URL::part(2);

        $GLOBALS['HookManager']->subscribe("preParseRequest", $this->request);

        if ($this->request['controller'] == ".well-known")
            $this->request['controller'] = "";
        if ($this->request['action'] == "acme-challenge")
            $this->request['action'] = "acme_challenge";

        if ($this->request['controller'] == "") {
            $this->controller = $GLOBALS['Config']['defaults']['controller'];
        } else {
            $this->controller = $this->request['controller'];
        }
        if ($this->request['action'] == "") {
            $this->action = $GLOBALS["Config"]["defaults"]["action"];
        } else {
            $this->action = $this->request['action'];
        }

        $GLOBALS['HookManager']->subscribe("postParseRequest", $this->request);
    }

    public function createController()
    {
        $GLOBALS['HookManager']->subscribe("preCreateController", $this->controller);
        // Check Class
        if (class_exists($this->controller)) {
            try {
                $reflectClass = new \ReflectionClass($this->controller);
            } catch (\ReflectionException $e) {
                //TODO: Print error
            }
            // Check Extend
            if ($reflectClass->getParentClass()->getName() === 'core\abstracts\AppController') {
                if ($reflectClass->hasMethod($this->action)) {
                    return new $this->controller($this->action, $this->request);
                } else {
                    // Method Does Not Exist
                    echo "<h1>Method does not exist</h1>";
                    return null;
                }
            } else {
                // Base controller not found
                echo "<h1>{$this->controller} controller not found</h1>";
                return null;
            }
        } else {
            // Controller Class Does Not Exist
            echo "<h1>Controller Class does not exist</h1>";
            return null;
        }
    }
}