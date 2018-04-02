<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 09.03.2018
 * Time: 16:28
 */

namespace core;

use Noodlehaus\Config;
use Noodlehaus\Exception\EmptyDirectoryException;

/**
 * @Name = Ozone Framework
 * @Version = 0.0.3
 */
class Ozone
{
    private $bootstrap;
    public function __construct($confFile = 'config/default.php')
    {
        /* Set GLOBALS */
        $GLOBALS['hook'] = array();

        /* Initialize System Base */
        $GLOBALS['HookManager'] = new \core\classes\HookManager();
        try {
            $GLOBALS['Config'] = new Config($confFile);
        } catch (EmptyDirectoryException $e) {
            echo 'Error while loading config file: \r\n' . $e->getTraceAsString();
        }
        $this->bootstrap = new \core\classes\Bootstrap();
    }

    public function start()
    {
        $this->bootstrap->parseRequest();
        $controller = $this->bootstrap->createController();
        if ($controller) {
            $controller->executeAction();
        }
    }
}