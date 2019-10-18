<?php
declare(strict_types=1);


use App\Controllers\PageController;
use App\Services\Core\Router;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase
{
    /**
     * The router
     *
     * @var Router
     */
    private $router;

    public function setUp(): void
    {
        $this->router = new Router();
    }

    public function test_that_we_can_get_the_router()
    {
        $this->assertInstanceOf(
            Router::class,
            $this->router->load('testRoutes.php',
                TEST_PATH . '/unit/router/')
        );
    }

    public function test_that_we_cannot_get_the_router()
    {
        $this->expectException(Exception::class);

        $this->router->load('test');
    }

    public function test_that_we_can_set_a_get_route()
    {
        $this->assertNull(
            Router::get('', PageController::class)
        );
    }

    public function test_that_we_can_set_a_post_route()
    {
        $this->assertNull(
            Router::post('test', PageController::class)
        );
    }

    public function test_that_we_can_direct_an_url_to_a_route()
    {
        $this->assertEquals("index",
            $this->router->load('testRoutes.php',
                TEST_PATH . '/unit/router/')
                ->direct('test', 'GET', 0)
        );
    }

    public function test_that_we_can_direct_a_non_existing_url_to_a_route()
    {
        $this->assertEquals("404",
            $this->router->load('testRoutes.php',
                TEST_PATH . '/unit/router/')
                ->direct('404', 'GET', 0)
        );
    }

    public function test_that_we_cannot_direct_an_url_to_a_route()
    {
        $this->expectException(Exception::class);

        $this->router->load('testNonExistingRoutes.php',
            TEST_PATH . '/unit/router/')
            ->direct('unknown_route', 'GET', 0);
    }

    public function test_that_we_can_only_direct_a_route_with_the_user_his_own_rights()
    {
        $this->assertEquals(
            'index',
            $this->router->load('testRoutes.php',
                TEST_PATH . '/unit/router/')
                ->direct('test', 'GET', 1)
        );

        $this->assertEquals(
            '1',
            $this->router->load('testRoutes.php',
                TEST_PATH . '/unit/router/')
            ->direct('testRights', 'GET', 1)
        );

        $this->assertNotEquals(
            '1',
            $this->router->load('testRoutes.php',
                TEST_PATH . '/unit/router/')
                ->direct('testRights', 'GET', 2)
        );
    }

    public function test_that_we_can_direct_a_route_with_a_wildcard()
    {
        $this->assertEquals(
            'wildcard',
            $this->router->load('testRoutes.php',
                TEST_PATH . '/unit/router/')
                ->direct('wildcard/test', 'GET', 3)
        );

        $this->assertEquals(
            Router::getWildcard(),
            'test'
        );
    }

    public function test_that_we_cannot_direct_a_route_with_a_wildcard()
    {
        $this->assertEquals(
            '404',
            $this->router->load('testRoutes.php',
                TEST_PATH . '/unit/router/')
                ->direct('test/wildcard/too/short', 'GET', 3)
        );

        $this->assertNotEquals(
            Router::getWildcard(),
            null
        );
    }
}
