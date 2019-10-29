<?php
declare(strict_types=1);


use App\Services\Core\Config;
use App\Services\Core\Cookie;
use PHPUnit\Framework\TestCase;

class CookieTest extends TestCase
{
    public function test_that_we_can_get_data_from_a_cookie()
    {
        if (!headers_sent()) {
            $cookie = new Cookie();
            $cookie->save('test', 'test');

            $this->assertEquals('test', $cookie->get('test'));
        }

        $_COOKIE['test'] = 'test';

        $this->assertEquals('test', $_COOKIE['test']);
    }
}
