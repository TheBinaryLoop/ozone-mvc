<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 14.04.2018
 * Time: 15:08
 */

namespace Ozone\Ozone\Tests;

use Ozone\Core\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    public function testError()
    {
        $logger = new Logger(true, __DIR__ . '\\..\\logs\\LoggerTest.log');
        $this->assertEquals(38, $logger->error(__FILE__, "TestCase Error!"));
    }

    public function testWarning()
    {
        $logger = new Logger(true, __DIR__ . '\\..\\logs\\LoggerTest.log');
        $this->assertEquals(40, $logger->error(__FILE__, "TestCase Warning!"));
    }

    public function testFatal()
    {
        $logger = new Logger(true, __DIR__ . '\\..\\logs\\LoggerTest.log');
        $this->assertEquals(38, $logger->error(__FILE__, "TestCase Fatal!"));
    }

    public function testInfo()
    {
        $logger = new Logger(true, __DIR__ . '\\..\\logs\\LoggerTest.log');
        $this->assertEquals(37, $logger->error(__FILE__, "TestCase Info!"));
    }

    public function testDebug()
    {
        $logger = new Logger(true, __DIR__ . '\\..\\logs\\LoggerTest.log');
        $this->assertEquals(38, $logger->error(__FILE__, "TestCase Debug!"));
    }

    public function __destruct()
    {
        if (file_exists(__DIR__ . '\\..\\logs\\LoggerTest.log'))
            unlink(__DIR__ . '\\..\\logs\\LoggerTest.log');
    }
}
