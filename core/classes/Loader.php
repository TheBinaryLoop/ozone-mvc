<?php

/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 18.02.2018
 * Time: 13:38
 */

namespace core\classes;

use Handlebars\Handlebars;

class Loader
{
    static function loadView($viewFile, $viewVars = array(), $handlebarView = null, $browserHandled = null, $dwooView = null)
    {
        $viewFile = str_replace("::", "/", $viewFile);
        $filename = $GLOBALS["Config"]["path"]["app"]."views/{$viewFile}";

        /* Hook: onLoadView */
        $result = $GLOBALS['HookManager']->subscribe("onLoadView", $viewFile);
        if (!is_null($result) && $result === false)
            return;

        if (is_null($handlebarView)) {
            $handlebarView = $GLOBALS["Config"]["engines"]["handlebars_enabled"];
        }
        if (is_null($dwooView))
        {
            $dwooView = $GLOBALS["Config"]["engines"]["dwoo_enabled"];
        }
        if ($handlebarView) {
            if(is_null($browserHandled)){
                $browserHandled = $GLOBALS["Config"]["engines"]["handlebars_browser_handled"];
            }
            if($browserHandled){
                self::loadBrowserHandlebarsView($filename, $viewVars);
            }
            else
            {
                self::loadHandlebarsView($filename, $viewVars);
            }
        }
        elseif ($dwooView)
        {
            self::loadDwooView($filename, $viewVars);
        }
        else
        {
            self::loadNativeView($filename, $viewVars);
        }
    }

    static function loadNativeView($viewFile, $viewVars = array())
    {
        $viewFile = self::checkFileExtension($viewFile);
        extract($viewVars);
        if (file_exists($viewFile))
            require_once $viewFile;
        else
            die("Trying to load non existing View");
    }

    static function loadHandlebarsView($viewFile, $viewVars = array())
    {
        if (file_exists($viewFile))
        {
            $engine = new Handlebars();
            echo $engine->render(file_get_contents($viewFile), $viewVars);
        }
        else
            die("Trying to load non existing View");
    }

    static function loadBrowserHandlebarsView($viewFile, $viewVars = array())
    {
        if(file_exists($viewFile)){
            echo "<!DOCTYPE html><html><head><title>Loading</title></head><body><h1>Loading...</h1><script src='https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.0.5/handlebars.js'></script><script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js'></script>"
                . "<script id='pageTemplate' type='text/x-handlebars-template'>".file_get_contents($viewFile)."</script><script>$(document).ready(function(){"
                . "var source = $('#pageTemplate').html(); var template = Handlebars.compile(source); var context = ".  json_encode($viewVars)."; $('html').html(template(context)); });</script></body></html>";
        }else{
            die("Trying to Load Non Existing Handlebar");
        }
    }

    static function loadDwooView($viewFile, $viewVars = array())
    {
        //TODO: Implement Dwoo template loader
    }

    static function loadHead($title = "Ozone")
    {
        $data["title"] = $title;
        self::loadView("template::head", $data);
    }

    static function loadHeader()
    {
        self::loadView("template::header");
    }

    static function loadMenu($activeTab)
    {
        $data["activeTab"] = $activeTab;
        self::loadView("template::menu", $data);
    }

    static function loadFooter()
    {
        self::loadView("template::footer");
    }

    private static function checkFileExtension($filename, $extension = ".php")
    {
        $viewFileCheck = explode(".", $filename);
        if (!isset($viewFileCheck[1]))
        {
            $filename .= $extension;
        }
        return $filename;
    }

}