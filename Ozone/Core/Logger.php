<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 14.04.2018
 * Time: 13:55
 */

namespace Ozone\Core;


/**
 * Class Logger
 * @version 0.0.4
 * @author Lukas Eßmann
 * @package Ozone\Core
 */
class Logger
{
    /**
     * The logfile.
     * @var string
     */
    private $logFile;
    /**
     * This is used to make UnitTests more comfortable.
     * @var bool
     */
    private $isTest;

    /**
     * Logger constructor.
     * @param bool $isTest
     * @param string $path
     */
    public function __construct(bool $isTest = false, string $path = '')
    {
        if ($isTest)
        {
            $this->logFile = $path;
            $this->isTest = true;
        } else {
            $this->logFile = __DIR__ . '\\..\\..\\logs\\' . date('Y-m-d') . '.log';
            $this->isTest = false;
        }
    }

    /**
     * Logs a debug message.
     * @param string $file
     * @param string $message
     * @return bool|int
     */
    public function debug(string $file, string $message)
    {
        return $this->writeLogLine($file, "Debug", $message);
    }

    /**
     * Logs a info.
     * @param string $file
     * @param string $message
     * @return bool|int
     */
    public function info(string $file, string $message)
    {
        return $this->writeLogLine($file, "Info", $message);
    }

    /**
     * Logs a warning.
     * @param string $file
     * @param string $message
     * @return bool|int
     */
    public function warning(string $file, string $message)
    {
        return $this->writeLogLine($file, "Warning", $message);
    }

    /**
     * Logs a error.
     * @param string $file
     * @param string $message
     * @return bool|int
     */
    public function error(string $file, string $message)
    {
        return $this->writeLogLine($file, "Error", $message);
    }

    /**
     * Logs a fatal error.
     * @param string $file
     * @param string $message
     * @return bool|int
     */
    public function fatal(string $file, string $message)
    {
        return $this->writeLogLine($file, "Fatal", $message);
    }

    /**
     * Creates the log line and writes it to disk.
     * @param string $file
     * @param string $logLevel
     * @param string $message
     * @return bool|int
     */
    private function writeLogLine(string $file, string $logLevel, string $message)
    {
        if ($this->isTest)
            $logLine = "[TEST_RUNNER][{$logLevel}] {$message}".PHP_EOL;
        else
            $logLine = "[" . date("Y-m-d h:m:s") . "][{$file}][{$logLevel}] {$message}".PHP_EOL;
        return file_put_contents($this->logFile, $logLine, FILE_APPEND);
    }
}