<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 18.02.2018
 * Time: 13:33
 */
 
 class Home extends \core\abstracts\AppController
{
    function index()
    {
        $this->returnView("home::index");
    }
}
