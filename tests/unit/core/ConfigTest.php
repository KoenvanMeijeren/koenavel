<?php
declare(strict_types=1);


use App\services\core\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function test_that_we_can_get_a_config_item()
    {
        Config::set('test', 'test');

        $this->assertEquals('test', Config::get('test'));
    }

    public function test_that_we_cannot_get_a_config_item()
    {
        $this->expectException(Exception::class);

        Config::get('empty');
    }

    public function test_that_we_can_unset_a_config_item()
    {
        Config::set('unset', 'test');
        Config::unset('unset');

        $this->expectException(Exception::class);

        Config::get('unset');
    }

    public function test_that_we_can_unset_all_config_items()
    {
        Config::set('unsetAll', 'test');
        Config::unsetAll();

        $this->expectException(Exception::class);

        Config::get('unsetAll');
    }

    public function test_that_we_cannot_add_duplicated_config_items()
    {
        $this->expectException(Exception::class);

        Config::set('duplicate', 'test');
        Config::set('duplicate', 'test');
    }

    public function test_that_we_can_change_the_config_state_into_prepared()
    {
        $this->assertFalse(Config::isPrepared());

        Config::setPreparedState();

        $this->assertTrue(Config::isPrepared());
    }

    public function test_that_we_can_sanitize_a_config_item()
    {
        Config::set('sanitize', '<script>');
        Config::set('sanitize1', '   test    ');

        $this->assertNotEquals('<script>', Config::get('sanitize'));
        $this->assertNotEquals('   test    ', Config::get('sanitize1'));
    }
}
