<?php
declare(strict_types=1);


use App\services\Core\Config;
use App\services\Core\Cookie;
use PHPUnit\Framework\TestCase;

class CookieTest extends TestCase
{
    public function setUp(): void
    {
        // ENCRYPTION TOKEN
        Config::set(
            'encryptionToken',
            'def00000bf6a79439be74b32d34b4c00dcb528a02f654b34472d1ca02383fc0284804eaa8404d6d0af3c41f7651d7f5d424af236f0daee2eea3704d00af9b1f68b31317b'
        );
    }

    public function test_that_we_can_get_data_from_a_cookie()
    {
        if (!headers_sent()) {
            $cookie = new Cookie();
            $cookie->save('test', 'test');

            $this->assertEquals('test', Cookie::get('test'));
        }

        $_COOKIE['test'] = 'test';

        $this->assertEquals('test', $_COOKIE['test']);
    }

    public function tearDown(): void
    {
        Config::unset('encryptionToken');
    }
}
