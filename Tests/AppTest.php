<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 14.04.2018
 * Time: 13:34
 */

namespace Ozone\Ozone\Tests;

use Ozone\Core\App;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $configFilePath can't be null or empty!
     * @expectedExceptionCode 0
     */
    public function testLoadConfigThrowsExceptionOnEmptyArgument()
    {
        $app = new App();
        $app->loadConfig("");
    }

    public function testGlobals()
    {
        $app = new App();
        $this->assertTrue(isset($GLOBALS['Logger']));
        $this->assertEmpty($GLOBALS['hook']);
        $this->assertTrue(isset($GLOBALS['HookManager']));
        $this->assertTrue(isset($GLOBALS['Config']));
    }
}
