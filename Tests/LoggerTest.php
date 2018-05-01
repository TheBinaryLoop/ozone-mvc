<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 14.04.2018
 * Time: 15:08
 */

namespace Ozone\Ozone\Tests;

use org\bovigo\vfs\vfsStream;
use Ozone\Core\Logger;
use PHPUnit\Framework\TestCase;

class LoggerTest extends TestCase
{
    private $file_system;
    private $log_file;

    protected function setUp()
    {
        $directory = [
          'logs' => [
              'LoggerTest.log' => ''
          ]
        ];
        $this->file_system = vfsStream::setup('root', null, $directory);
        $this->log_file = $this->file_system->url() . '/logs/LoggerTest.log';
    }

    public function testError()
    {
        $logger = new Logger(true, $this->log_file);
        $this->assertTrue($logger->error(__FILE__, "TestCase Error!") !== false);
    }

    public function testWarning()
    {
        $logger = new Logger(true, $this->log_file);
        $this->assertTrue($logger->error(__FILE__, "TestCase Warning!") !== false);
    }

    public function testFatal()
    {
        $logger = new Logger(true, $this->log_file);
        $this->assertTrue($logger->error(__FILE__, "TestCase Fatal!") !== false);
    }

    public function testInfo()
    {
        $logger = new Logger(true, $this->log_file);
        $this->assertTrue($logger->error(__FILE__, "TestCase Info!") !== false);
    }

    public function testDebug()
    {
        $logger = new Logger(true, $this->log_file);
        $this->assertTrue($logger->error(__FILE__, "TestCase Debug!") !== false);
    }
}
