<?php
declare(strict_types=1);


use App\Services\Core\Config;
use App\Services\Core\Env;
use App\Services\Exceptions\Basic\AppIsNotConfiguredException;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function test_that_we_can_load_the_config_items()
    {
        $config = new \App\Services\Config\ConfigLoader(Env::DEVELOPMENT);
        $config->load();

        $this->assertNotEmpty(Config::get('appName')->toString());
        $this->assertIsString(Config::get('appName')->toString());
        $this->assertTrue($config->checkConfigState());
    }

    public function test_that_we_cannot_load_the_config_items()
    {
        Config::unsetAll();
        $this->expectException(AppIsNotConfiguredException::class);

        $config = new \App\Services\Config\ConfigLoader(Env::DEVELOPMENT);
        $config->checkConfigState();
    }

    public function test_that_we_can_get_a_config_item()
    {
        Config::set('test', 'test');
        Config::set('test1', ['test' => 'test']);

        $this->assertEquals('test', Config::get('test')->toString());
        $this->assertIsArray(Config::get('test1')->toArray());
    }

    public function test_that_we_cannot_get_a_config_item()
    {
        $this->expectException(Exception::class);

        Config::get('empty')->toString();
    }

    public function test_that_we_can_unset_a_config_item()
    {
        Config::set('unset', 'test');
        Config::unset('unset');

        $this->expectException(Exception::class);

        Config::get('unset')->toString();
    }

    public function test_that_we_cannot_unset_a_config_item()
    {
        $this->expectException(Exception::class);

        Config::unset('non_existing_item');
    }

    public function test_that_we_can_unset_all_config_items()
    {
        Config::set('unsetAll', 'test');
        Config::unsetAll();

        $this->expectException(Exception::class);

        Config::get('unsetAll')->toString();
    }

    public function test_that_we_cannot_add_duplicated_config_items()
    {
        $this->expectException(Exception::class);

        Config::set('duplicate', 'test');
        Config::set('duplicate', 'test');
    }

    public function test_that_we_can_sanitize_a_config_item()
    {
        Config::set('sanitize', '<script>');
        Config::set('sanitize1', '   test    ');

        $this->assertNotEquals(
            '<script>', Config::get('sanitize')->toString()
        );
        $this->assertNotEquals(
            '   test    ',
            Config::get('sanitize1')->toString()
        );
    }
}
