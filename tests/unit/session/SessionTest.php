<?php
declare(strict_types=1);


use App\services\core\Config;
use App\services\session\Session;
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    public function setUp(): void
    {
        // ENCRYPTION TOKEN
        Config::set(
            'encryptionToken',
            'def00000bf6a79439be74b32d34b4c00dcb528a02f654b34472d1ca02383fc0284804eaa8404d6d0af3c41f7651d7f5d424af236f0daee2eea3704d00af9b1f68b31317b'
        );
        Config::set('appName', 'TestApp');
    }

    public function test_that_we_can_get_data_from_the_session()
    {
        Session::save('test', 'test');

        $this->assertEquals('test', Session::get('test'));

        unset($_SESSION['test']);
    }

    public function test_that_we_cannot_get_duplicated_data_from_the_session()
    {
        Session::save('test', 'test');
        Session::save('test', 'test2');

        $this->assertNotEquals(
            'test2',
            Session::get('test')
        );

        unset($_SESSION['test']);
    }

    public function test_that_we_cannot_get_data_from_the_session()
    {
        $this->assertEmpty(
            Session::get('test_non_existing_item')
        );
    }

    public function test_that_we_can_save_data_forced_into_the_session()
    {
        Session::save('test', 'test');
        Session::saveForced('test', 'test2');

        $this->assertNotEquals(
            'test',
            Session::get('test2')
        );

        unset($_SESSION['test']);
    }

    public function test_that_we_can_unset_data_from_the_session()
    {
        Session::save('test', 'test');
        $this->assertNotEmpty(Session::get('test'));

        Session::unset('test');
        $this->assertEmpty(Session::get('test'));
    }

    public function test_that_we_can_flash_data_into_the_session()
    {
        Session::flash('test', 'test');

        $this->assertEquals(
            'test',
            Session::get('test')
        );

        Session::unset('test');
    }

    public function tearDown(): void
    {
        Config::unset('encryptionToken');
        Config::unset('appName');
    }
}
