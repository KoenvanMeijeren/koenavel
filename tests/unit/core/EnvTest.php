<?php
declare(strict_types=1);


use App\services\core\Config;
use App\services\core\Env;
use PHPUnit\Framework\TestCase;

class EnvTest extends TestCase
{
    private $env;

    public function test_that_we_can_turn_on_the_error_handling()
    {
        $_SERVER['HTTP_HOST'] = 'localhost';
        $this->env = new Env();

        $this->assertEquals('1', ini_get('display_errors'));
        $this->assertEquals('1', ini_get('display_startup_errors'));
    }

    public function test_that_we_can_turn_off_the_error_handling()
    {
        $_SERVER['HTTP_HOST'] = 'www.test.com';
        $this->env = new Env();

        $this->assertEquals('0', ini_get('display_errors'));
        $this->assertEquals('0', ini_get('display_startup_errors'));
    }

    public function test_that_we_can_see_an_error()
    {
        $_SERVER['HTTP_HOST'] = 'localhost';
        $this->env = new Env();

        $this->expectException(ErrorException::class);
        echo $test;
    }

    public function test_that_we_cannot_see_an_error()
    {
        $_SERVER['HTTP_HOST'] = 'www.test.com';
        $this->env = new Env();

        $this->expectException(ErrorException::class);
        echo $test;
    }

    public function tearDown(): void
    {
        unset($this->env);
        Config::unsetAll();
    }
}
