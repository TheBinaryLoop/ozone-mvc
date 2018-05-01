<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 01.05.2018
 * Time: 15:10
 */

namespace Ozone\Ozone\Tests;

use Ozone\Core\Helpers\URLHelper;
use PHPUnit\Framework\TestCase;

class URLHelperTest extends TestCase
{
    private $http_url = "http://ozonemvc.com/";
    private $https_url = "https://ozonemvc.com/";


    public function testGetReturnsFalseIfRequestedParameterIsNotSet()
    {
        $this->assertFalse(URLHelper::get('test'));
    }

    public function testGetReturnsValueOfRequestedParameterIfSet()
    {
        $_GET['test'] = True;
        $this->assertTrue(URLHelper::get('test'));
        unset($_GET['test']);
    }

    public function testGetBaseURLReturnsHTTPAddressWithSERVER_HTTPSSetToOffAndSERVER_PORTSetTo80()
    {
        $_SERVER['HTTPS'] = 'off';
        $_SERVER['SERVER_PORT'] = 80;
        $this->assertEquals($this->http_url, URLHelper::getBaseURL());
        unset($_SERVER['HTTPS']);
        unset($_SERVER['SERVER_PORT']);
    }

    public function testGetBaseURLReturnsHTTPAddressWithSERVER_PORTSetTo80()
    {
        $_SERVER['SERVER_PORT'] = 80;
        $this->assertEquals($this->http_url, URLHelper::getBaseURL());
        unset($_SERVER['SERVER_PORT']);
    }

    public function testGetBaseURLReturnsHTTPSAddressWithSERVER_HTTPSSetToOn()
    {
        $_SERVER['HTTPS'] = 'on';
        $this->assertEquals($this->https_url, URLHelper::getBaseURL());
        unset($_SERVER['HTTPS']);
    }

    public function testGetBaseURLReturnsHTTPSAddressWithSERVER_PORTSetTo443()
    {
        $_SERVER['SERVER_PORT'] = 443;
        $this->assertEquals($this->https_url, URLHelper::getBaseURL());
        unset($_SERVER['SERVER_PORT']);
    }

    public function testPartReturnsTheRightPartsOfTheURI()
    {
        $_SERVER['REQUEST_URI'] = "/home/index";
        $this->assertEquals("home", URLHelper::part(1));
        $this->assertEquals("index", URLHelper::part(2));
        unset($_SERVER['REQUEST_URI']);
    }

    public function testRequestReturnsFalseIfRequestedParameterIsNotSet()
    {
        $this->assertFalse(URLHelper::request('test_not_existent'));
    }

    public function testRequestReturnsValueOfRequestedParameterIfSet_GET()
    {
        $_GET['test_get'] = True;
        $this->assertTrue(URLHelper::request('test_get'));
        unset($_GET['test_get']);
    }

    public function testRequestReturnsValueOfRequestedParameterIfSet_POST()
    {
        $_POST['test_post'] = True;
        $this->assertTrue(URLHelper::request('test_post'));
        unset($_POST['test_post']);
    }

    public function testPostReturnFalseIfRequestedParameterIsNotSet()
    {
        $this->assertFalse(URLHelper::post('test'));
    }

    public function testPostReturnValueOfRequestedParameterIfSet()
    {
        $_POST['test'] = True;
        $this->assertTrue(URLHelper::post('test'));
        unset($_POST['test']);
    }

    public function testBuildReturnsRightUrl()
    {
        $this->assertEquals("//ozonemvc.com?this=1&is=just&a=1&test=insert", URLHelper::build('', array('this' => 1, 'is' => 'just', 'a' => True, 'test' => 'insert')));
    }
}
