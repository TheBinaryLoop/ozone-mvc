<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 18.02.2018
 * Time: 12:57
 * */

function autoload($class) {
    $classPath = implode(DIRECTORY_SEPARATOR, explode('\\', $class)).'.php';
    if (file_exists($classPath)) {
        //echo 'Found file '.$classPath.'. Including...<br>';
        include_once $classPath;
    } else {
        //echo 'Couldn\'t parse namespace to file path. Searching for '.$class.'...<br>';
        if ($GLOBALS["Config"]["cache_enabled"] && file_exists($GLOBALS['Config']['path']['base'].$GLOBALS["Config"]["path"]["cache"] . "classloc.cache")) {
            //echo 'Cache active. Loading cache file located at '.$GLOBALS["Config"]["path"]["cache"] . "classloc.cache.<br>";
            $locations = unserialize(file_get_contents($GLOBALS['Config']['path']['base'].$GLOBALS["Config"]["path"]["cache"] . "classloc.cache"));
        } else {
            //echo 'Cache not active. Creating empty cache.<br>';
            $locations = array();
        }
        if (isset($locations[$class])) {
            //echo 'Found '.$class.' in cache. Including '.$locations[$class]["classFile"].'...<br>';
            require_once $locations[$class]["classFile"];
        } else {
            //echo 'Searching for '.$class.' in user app...<br>';
            $appPath = $GLOBALS['Config']['path']['base'].$GLOBALS['Config']['path']['app'];
            if (file_exists("{$appPath}controllers/{$class}.php")) {
                //echo 'Found file '."{$appPath}controllers/{$class}.php".'<br>';
                $classFile = "{$appPath}controllers/{$class}.php";
            } else if (file_exists("{$appPath}libs/{$class}.php")) {
                //echo 'Found file '."{$appPath}libs/{$class}.php".'<br>';
                $classFile = "{$appPath}libs/{$class}.php";
            } else if (file_exists("{$appPath}models/{$class}.php")) {
                //echo 'Found file '."{$appPath}models/{$class}.php".'<br>';
                $classFile = "{$appPath}models/{$class}.php";
            } else if (file_exists("{$appPath}interfaces/{$class}.php")) {
                //echo 'Found file '."{$appPath}interfaces/{$class}.php".'<br>';
                $classFile = "{$appPath}interfaces/{$class}.php";
            } else if (file_exists("{$appPath}abstracts/{$class}.php")) {
                //echo 'Found file '."{$appPath}abstracts/{$class}.php".'<br>';
                $classFile = "{$appPath}abstracts/{$class}.php";
            }
        }
        if (isset($classFile)) {
            if ($GLOBALS["Config"]["cache_enabled"]) {
                $locations[$class] = array(
                    "classFile" => $classFile
                );
                file_put_contents($GLOBALS['Config']['path']['base'].$GLOBALS["Config"]["path"]["cache"] . "classloc.cache", serialize($locations));
            }
            require_once $classFile;
        }

    }
}

spl_autoload_register('autoload');
