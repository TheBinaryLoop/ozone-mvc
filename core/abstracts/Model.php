<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 21.02.2018
 * Time: 16:57
 */

namespace core\abstracts;

abstract class Model
{
    public $model;

    function __construct()
    {
        $this->model = new \core\classes\Database($GLOBALS["Config"]["database"]["host"],
                                                    $GLOBALS["Config"]["database"]["username"],
                                                    $GLOBALS["Config"]["database"]["password"],
                                                    $GLOBALS["Config"]["database"]["name"]);
    }
}