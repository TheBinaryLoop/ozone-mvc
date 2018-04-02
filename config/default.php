<?php
return function () {
    return array(
        'appName' => 'your app name',
        'version' => '0.0.3',
        'domain' => 'yourdomain.com',
        'ssl' => false,
        'engines' => array(
            'handlebars_enabled' => false,
            'handlebars_browser_handled' => false,
            'dwoo_enabled' => false,
            'markdown' => false
        ),
        'cache_enabled' => false,
        'path' => array(
            'base' => 'yourbasepath',
            'app' => 'app/',
            'cache' => 'cache/',
            'core' => 'core/',
            'modules' => 'modules/',
            'assets' => 'assets/',
            'index' => 'index.php'
        ),
        'defaults' => array(
            'controller' => 'home',
            'action' => 'index'
        ),
        'database' => array(
            'host' => 'yourhost',
            'username' => 'youruser',
            'password' => 'yourpasword',
            'name' => 'yourdbname'
        )
    );
};
