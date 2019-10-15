<?php
declare(strict_types=1);


use App\services\Core\URI;
use PHPUnit\Framework\TestCase;

class URITest extends TestCase
{
    public function setUp(): void
    {
        $_SERVER['REQUEST_URI'] = '/home';
        $_SERVER['HTTP_REFERER'] = '/contact';
        $_SERVER['HTTP_HOST'] = 'localhost';
        $_SERVER['REMOTE_ADDR'] = '::1';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['HTTP_USER_AGENT'] = 'Mozilla/5.0 ' .
        '(Windows NT 10.0; Win64; x64)' .
        'AppleWebKit/537.36 (KHTML, like Gecko)' .
        'Chrome/77.0.3865.75 Safari/537.36';
    }

    public function test_that_we_can_get_an_url()
    {
        $this->assertEquals('home', URI::getUrl());
    }

    public function test_that_we_can_get_a_http_referer()
    {
        $this->assertEquals('contact', URI::getPreviousUrl());
    }

    public function test_that_we_can_get_a_http_host()
    {
        $this->assertEquals('localhost', URI::getHost());
    }

    public function test_that_we_can_get_a_remote_addr()
    {
        $this->assertEquals('::1', URI::getRemoteIp());
    }

    public function test_that_we_can_get_a_request_method()
    {
        $this->assertEquals('GET', URI::method());
    }

    public function test_that_we_can_get_a_http_user_agent()
    {
        $this->assertEquals(
            'Mozilla/5.0 (Windows NT 10.0; Win64; x64)' .
            'AppleWebKit/537.36 (KHTML, like Gecko)' .
            'Chrome/77.0.3865.75 Safari/537.36', URI::getUserAgent());
    }
}
