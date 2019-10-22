<?php
declare(strict_types=1);


use App\Services\Core\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    /**
     * @var Request
     */
    private $request;

    public function setUp(): void
    {
        $_POST['test'] = 'test';
        $_POST['array'] = ['test' => 1];
        $_GET['test'] = 'test';
        $_GET['array'] = ['test' => 1];
        $_ENV['test'] = 'test';
        $_ENV['array'] = ['test' => 1];
        $_COOKIE['test'] = 'test';
        $_COOKIE['array'] = ['test' => 1];
        $_FILES['test'] = ['test' => 'test'];

        $this->request = new Request();
    }

    public function test_that_we_can_get_a_post_item()
    {
        $this->assertEquals('test', $this->request->post('test'));
        $this->assertIsArray(json_decode($this->request->post('array')));
    }

    public function test_that_we_cannot_get_a_post_item()
    {
        $this->assertEquals(
            '', $this->request->post('non_existing_item')
        );
    }

    public function test_that_we_can_get_a_get_item()
    {
        $this->assertEquals('test', $this->request->get('test'));
        $this->assertIsArray(json_decode($this->request->get('array')));
    }

    public function test_that_we_cannot_get_a_get_item()
    {
        $this->assertEquals(
            '', $this->request->get('non_existing_item')
        );
    }

    public function test_that_we_can_get_a_env_item()
    {
        $this->assertEquals('test', $this->request->env('test'));
        $this->assertIsArray(json_decode($this->request->env('array')));
    }

    public function test_that_we_cannot_get_a_env_item()
    {
        $this->assertEquals(
            '', $this->request->env('non_existing_item')
        );
    }

    public function test_that_we_can_get_a_cookie_item()
    {
        $this->assertEquals('test', $this->request->cookie('test'));
        $this->assertIsArray(json_decode($this->request->cookie('array')));
    }

    public function test_that_we_cannot_get_a_cookie_item()
    {
        $this->assertEquals(
            '', $this->request->cookie('non_existing_item')
        );
    }

    public function test_that_we_can_get_a_file_item()
    {
        $this->assertNotEmpty($this->request->file('test'));
        $this->assertIsArray($this->request->file('test'));
        $this->assertArrayHasKey('test', $this->request->file('test'));
    }

    public function test_that_we_cannot_get_a_file_item()
    {
        $this->assertEquals(
            [], $this->request->file('non_existing_item')
        );
    }
}
