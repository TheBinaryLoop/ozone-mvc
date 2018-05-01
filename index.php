<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 18.02.2018
 * Time: 12:41
 */
error_reporting(E_ALL);

/* Loading the Constants */
require_once __DIR__ . '/Ozone/Core/Constants.php';
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
