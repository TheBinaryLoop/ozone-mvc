<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 18.02.2018
 * Time: 12:41
 */
error_reporting(E_ALL);

require_once __DIR__ . '/core/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';

$app = new \core\Ozone();
$app->start();

/* Available Hooks */
// onLoadView
// preParseRequest
// postParseRequest
// preCreateController
