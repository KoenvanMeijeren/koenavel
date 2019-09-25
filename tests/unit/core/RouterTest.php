<?php
declare(strict_types=1);


use App\services\core\Router;
use App\services\core\View;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    public function test_that_we_can_get_the_router()
    {
        $this->assertInstanceOf(
            Router::class,
            Router::load('testRoutes.php')
        );
    }

    public function test_that_we_cannot_get_the_router()
    {
        $this->expectException(Exception::class);

        Router::load('test');
    }

    public function test_that_we_can_set_a_route()
    {
        $this->assertNull(
            Router::get('', 'PageController@index')
        );

        $this->assertNull(
            Router::post('test', 'PageController@store')
        );
    }

    public function test_that_we_can_direct_a_route()
    {
        $this->expectOutputString("<h1>Test view</h1>\n");
        Router::load('testRoutes.php')
            ->direct('', 'GET', 0);
    }

    public function test_that_we_cannot_direct_a_route()
    {
        $this->expectException(Exception::class);
        Router::load('testRoutes.php')
            ->direct('unknown_route', 'GET', 0);
    }

    public function test_that_we_can_only_direct_a_route_with_the_correct_user_rights()
    {
        $this->expectOutputString("<h1>Test view</h1>\n");
        Router::load('testRoutes.php')
            ->direct('', 'GET', 0);

        $this->expectException(Exception::class);
        Router::load('testRoutes.php')
            ->direct('test', 'GET', 0);
    }

    public function test_that_we_can_direct_a_route_with_a_wildcard()
    {
        $_SERVER['REQUEST_URI'] = '/test/1';

        $this->expectOutputString("<h1>Test view</h1>\n");
        Router::load('testRoutes.php')
            ->direct('test/1', 'GET', 1);

        $this->assertEquals(1, Router::getWildcard());
    }
}
