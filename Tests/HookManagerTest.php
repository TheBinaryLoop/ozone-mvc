<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 14.04.2018
 * Time: 15:26
 */

namespace Ozone\Ozone\Tests;

use Ozone\Core\HookManager;
use PHPUnit\Framework\TestCase;

class HookManagerTest extends TestCase
{

    public function testWatch()
    {
        $GLOBALS['hook'] = array();
        $manager = new HookManager();
        $manager->watch('testChannel', function () {});
        $this->assertNotEmpty($GLOBALS['hook']);
        $this->assertEquals(function () {}, $GLOBALS['hook']['testChannel'][0]);
        unset($GLOBALS['hook']);
    }

    public function testSubscribe()
    {
        $GLOBALS['hook'] = array();
        $manager = new HookManager();
        $manager->watch('testChannel', function ($data) {
            return str_replace('not ', '', $data);
        });
        $testData = 'This hook has not worked!';
        $this->assertEquals('This hook has worked!', $manager->subscribe('testChannel', $testData));
    }

    /**
     * @expectedException UnexpectedValueException
     * @expectedExceptionMessage $GLOBALS['hook'] can't be null
     */
    public function testConstructWithoutGlobalHookArray()
    {
        unset($GLOBALS['hook']);
        new HookManager();
    }

    /**
     * @expectedException TypeError
     * @expectedExceptionMessage $GLOBALS['hook'] must be of type array
     */
    public function testConstructWithGlobalHookArrayWrongType()
    {
        $GLOBALS['hook'] = "Test";
        new HookManager();
    }
}
