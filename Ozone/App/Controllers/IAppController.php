<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 14.04.2018
 * Time: 22:33
 */

namespace Ozone\App\Controllers;


/**
 * Interface IAppController
 * @version 0.0.1
 * @author Lukas Eßmann
 * @package Ozone\App\Controllers
 */
interface IAppController
{
    /**
     * The default page.
     * @return mixed
     */
    function index();
}