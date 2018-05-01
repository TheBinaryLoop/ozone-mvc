<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 14.04.2018
 * Time: 22:35
 */

namespace Ozone\App\Controllers;

use Ozone\Core\HookManager;


/**
 * Class AppController
 * @package Ozone\App\Controllers
 */
abstract class AppController implements IAppController
{
    /**
     * The detected action.
     * @var string
     */
    protected $action;
    /**
     * The request.
     * @var array
     */
    protected $request;

    /**
     * AppController constructor.
     * @param string $action
     * @param array $request
     */
    public function __construct($action, $request)
    {
        $this->action = $action;
        $this->request = $request;
    }

    /**
     * Executes the parsed action with the parsed controller.
     * @return mixed
     */
    public function executeAction()
    {
        $result = HookManager::getInstance()->subscribe("preParseRequest", $this->request);
        if (!is_null($result) && is_array($result))
            $this->request = $result;
        return $this->{$this->action}();
    }

    /**
     * Parses the view file and displays it.
     * @param string $viewFile
     * @param array $viewVars
     */
    protected function returnView($viewFile, $viewVars = array())
    {
        /*
         * TODO: Detect file type
         * TODO: Select ThemeEngine
         * TODO: Process view
         */
        \core\classes\Loader::loadView($viewFile, $viewVars);
    }
}