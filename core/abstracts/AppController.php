<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 18.02.2018
 * Time: 13:43
 */

namespace core\abstracts;

abstract class AppController implements \core\interfaces\IController
{
    protected $action;
    protected $request;

    public function __construct($action, $request)
    {
        $this->action = $action;
        $this->request = $request;
        //$GLOBALS["instances"][] = &$this;
    }

    public function executeAction()
    {
        $GLOBALS['HookManager']->subscribe("preParseRequest", $this->request);
        return $this->{$this->action}();
    }

    protected function returnView($viewFile, $viewVars = array())
    {
        \core\classes\Loader::loadView($viewFile, $viewVars);
    }

}