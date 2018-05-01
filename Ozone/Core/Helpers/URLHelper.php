<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 14.04.2018
 * Time: 16:12
 */

namespace Ozone\Core\Helpers;


/**
 * Class URLHelper
 * @version 0.0.4
 * @author Lukas Eßmann
 * @package Ozone\Core\Helpers
 */
class URLHelper
{
    /**
     * Returns part of the url if exists.
     * @param $number
     * @return mixed
     */
    public static function part($number)
    {
        if (!isset($_SERVER['REQUEST_URI']))
            return false;
        $uri = explode('?', $_SERVER['REQUEST_URI']);
        $parts = explode('/', $uri[0]);
        if($parts[1] == $GLOBALS["Config"]["path"]["index"])
        {
            $number++;
        }
        return isset($parts[$number]) ? $parts[$number] : false;
    }

    /**
     * Returns POST parameter if set.
     * @param $key
     * @return bool
     */
    public static function post($key)
    {
        return isset($_POST[$key]) ? $_POST[$key] : false;
    }

    /**
     * Returns GET parameter if set.
     * @param $key
     * @return bool
     */
    public static function get($key)
    {
        return isset($_GET[$key]) ? $_GET[$key] : false;
    }

    /**
     * Returns POST/GET parameter if set.
     * @param $key
     * @return bool
     */
    public static function request($key)
    {
        //TODO: Check if it works
        return self::get($key) ? self::get($key) : self::post($key) ? self::post($key) : false;

        /*
         * if(self::get($key))
         * {
         *     return self::get($key);
         * }
         * elseif(self::post($key))
         * {
         *     return self::post($key);
         * }
         * else
         * {
         *     return false;
         * }
         */
    }

    /**
     * Build base URL with config and server vars.
     * @return string
     */
    public static function getBaseURL()
    {
        return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443
            ? "https://".$GLOBALS['Config']['domain'].'/'
            : "http://".$GLOBALS['Config']['domain'].'/';
    }

    /**
     * I don't know what this function does :)
     * @param string $url
     * @param array $params
     * @return string
     */
    public static function build($url, $params = array())
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

    /**
     * I don't know what this function does :)
     * @param string $url
     * @return string
     */
    public static function simple($url)
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

    /**
     * Redirects to the specified url and exits if wanted.
     * @param string $to Target URL
     * @param bool $exit Set to true if app should die after redirecting
     */
    public static function redirect($to, $exit = true)
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