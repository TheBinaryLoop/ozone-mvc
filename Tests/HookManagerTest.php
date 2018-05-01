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

    public function testWatchAndSubscribe()
    {
        HookManager::getInstance()->watch('testChannel', function ($data) {
            return str_replace('not ', '', $data);
        });
        $testData = 'This hook has not worked!';
        $this->assertEquals('This hook has worked!', HookManager::getInstance()->subscribe('testChannel', $testData));
    }

}
