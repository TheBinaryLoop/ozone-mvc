<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 01.05.2018
 * Time: 15:04
 */

namespace Ozone\Ozone\Tests;

use Ozone\App\Controllers\AppController;
use Ozone\App\Controllers\Home;
use Ozone\Core\Bootstrap;
use PHPUnit\Framework\TestCase;

class BootstrapTest extends TestCase
{

    public function testCreateController()
    {
        $bt = new Bootstrap();
        $bt->parseRequest();
        $ctrl = $bt->createController();
        $this->assertTrue($ctrl instanceof AppController);
        $this->assertTrue($ctrl instanceof Home);
    }
}
