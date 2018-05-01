<?php
/**
 * The default configuration
 * @version 0.0.4
 * @author Lukas Eßmann
 * @package Ozone\Config
 */
return function () {
    return array(
        'appName' => 'Ozone MVC Framework',
        'version' => '0.0.4',
        'domain' => 'ozonemvc.com',
        'ssl' => false,
        'engines' => array(
            'handlebars_enabled' => false,
            'handlebars_browser_handled' => false,
            'dwoo_enabled' => false,
            'markdown' => false
        ),
        'cache_enabled' => false,
        'path' => array(
            'base' => 'P:\\xampp\\htdocs\\ozone-mvc\\Ozone\\',
            'app' => 'App/',
            'cache' => 'cache/',
            'core' => 'Core/',
            'modules' => 'modules/',
            'assets' => 'App/Assets/',
            'index' => 'index.php'
        ),
        'defaults' => array(
            'controller' => 'Home',
            'action' => 'index'
        ),
        'database' => array(
            'type' => 'mysql',  // Valid values are: mysql, sqlite, sqlite2, firebird, pgsql
            'host' => 'localhost',
            'port' => '3306',
            'path' => '',
            'username' => 'root',
            'password' => '',
            'dbname' => 'mcecho'
        )/*,
        'database' => array(
            'type' => 'mysql',
            'host' => 'yourhost',
            'username' => 'youruser',
            'password' => 'yourpasword',
            'name' => 'yourdbname'
        )*/

    );
};
