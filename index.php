<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 18.02.2018
 * Time: 12:41
 */
error_reporting(E_ALL);

/* Start collecting system information */
/* End collecting system information */

/* Start define useful constants */
// Utilities
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS);
// Program specific
require_once __DIR__ . '/Ozone/Core/Constants.php';
/* End define useful constants */


die($_SERVER['HTTP_HOST']);
$_autoloader = NATIVE_AUTOLOADER;
if (is_dir(ROOT . 'vendor') && file_exists(ROOT.'vendor'.DS.'autoload.php')) {
    $_autoloader = COMPOSER_AUTOLOADER;
}

// Try using composer to autoload file.
require_once __DIR__ . '/vendor/autoload.php';

$app = new Ozone\Core\App();
$app->bootstrap();

//\Ozone\Core\Template\TemplateTypeDetector::detect("F:\\Programing\\PHP\\7.0\\ozone-mvc\\Ozone\\App\\Views\\Home\\index.php");

//$engine = new Ozone\Core\Engines\MarkdownEngine();
//$engine->render('home::CHANGELOG', array());

/* Available Hooks */
// onLoadView
// preParseRequest
// postParseRequest
// preCreateController
