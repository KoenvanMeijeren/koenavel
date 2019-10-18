<?php
declare(strict_types=1);


use App\Services\Core\URI;
use PHPUnit\Framework\TestCase;

class URITest extends TestCase
{
    /**
     * The uri class.
     *
     * @var URI
     */
    private $uri;

    public function setUp(): void
    {
        $this->uri = new URI();

        $_SERVER['REQUEST_URI'] = '/home';
        $_SERVER['HTTP_REFERER'] = '/contact';
        $_SERVER['HTTP_HOST'] = 'localhost';
        $_SERVER['REQUEST_METHOD'] = 'GET';
    }

    public function test_that_we_can_get_an_url()
    {
        $this->assertEquals('home', $this->uri->getUrl());
    }

    public function test_that_we_can_get_a_http_referer()
    {
        $this->assertEquals('contact', $this->uri->getPreviousUrl());
    }

    public function test_that_we_can_get_a_http_host()
    {
        $this->assertEquals(
            'localhost', $this->uri->getDomainExtension()
        );
    }

    public function test_that_we_can_get_a_request_method()
    {
        $this->assertEquals('GET', $this->uri->getMethod());
    }
}
