<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 15.04.2018
 * Time: 15:11
 */

namespace Ozone\App\Controllers;


/**
 * Class Home
 * @version 0.0.1
 * @author Lukas Eßmann
 * @package Ozone\App\Controllers
 */
class Home extends AppController
{

    /**
     * Provides the home/index page
     */
    function index()
    {
        $this->returnView("home::index.php");
    }
}