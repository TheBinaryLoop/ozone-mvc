<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 21.02.2018
 * Time: 12:24
 */

namespace core\classes;

class URL
{
    static function part($number)
    {
        $uri = explode("?", $_SERVER["REQUEST_URI"]);
        $parts = explode("/", $uri[0]);
        if($parts[1] == $GLOBALS["Config"]["path"]["index"])
        {
            $number++;
        }
        return (isset($parts[$number])) ? $parts[$number] : false;
    }

    static function post($key)
    {
        return (isset($_POST[$key])) ? $_POST[$key] : false;
    }

    static function get($key)
    {
        return (isset($_GET[$key])) ? urldecode($_GET[$key]) : false;
    }

    static function request($key)
    {
        if(self::get($key))
        {
            return self::get($key);
        }
        elseif(self::post($key))
        {
            return self::post($key);
        }
        else
        {
            return false;
        }
    }

    static function getBaseURL()
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443
            ? "https://".$GLOBALS["Config"]["domain"]."/"
            : "http://".$GLOBALS["Config"]["domain"]."/";
    }

    static function build($url, $params = array())
    {
        if(strpos($url, "//") === false)
        {
            $prefix = "//".$GLOBALS["Config"]["domain"];
        }
        else
        {
            $prefix = "";
        }
        $append = "";
        foreach($params as $key => $param)
        {
            $append .= ($append == "") ? "?" : "&";
            $append .= urlencode($key)."=".urlencode($param);
        }
        return $prefix.$append;
    }

    static function simple($url)
    {
        if(strpos($url, "//") === false)
        {
            $prefix = "//".$GLOBALS["Config"]["domain"];
        }
        else
        {
            $prefix = "";
        }
        return $prefix;
    }

    static function redirect($to, $exit = true)
    {
        if(headers_sent())
        {
            echo "<script>window.location = '{$to}';</script>";
        }
        else
        {
            header("location: {$to}");
        }
        if($exit)
        {
            die();
        }
    }

}