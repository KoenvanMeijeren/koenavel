<?php
declare(strict_types=1);


use App\Services\Core\URI;
use PHPUnit\Framework\TestCase;

class URITest extends TestCase
{
    public function setUp(): void
    {
        $_SERVER['REQUEST_URI'] = '/home';
        $_SERVER['HTTP_REFERER'] = '/contact';
        $_SERVER['HTTP_HOST'] = 'localhost';
        $_SERVER['REQUEST_METHOD'] = 'GET';
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
        $this->assertEquals(
            'localhost', URI::getDomainExtension()
        );
    }

    public function test_that_we_can_get_a_request_method()
    {
        $this->assertEquals('GET', URI::getMethod());
    }

    /**
     * @runInSeparateProcess
     */
    public function test_that_we_can_get_the_redirect_header()
    {
        URI::redirect('/test');

        $this->assertContains(
            'Location: /test', xdebug_get_headers()
        );
    }

    /**
     * @runInSeparateProcess
     */
    public function test_that_we_can_get_the_refresh_header()
    {
        URI::refresh('/test', 3600);

        $this->assertContains(
            "Refresh: 3600; URL=/test", xdebug_get_headers()
        );
    }
}
