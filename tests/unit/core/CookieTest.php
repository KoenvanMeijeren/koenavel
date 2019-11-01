<?php
declare(strict_types=1);


use App\Src\Core\Cookie;
use PHPUnit\Framework\TestCase;

class CookieTest extends TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function test_that_we_can_set_data_in_a_cookie()
    {
        $cookie = new Cookie();

        $this->assertNull($cookie->save('test', 'test'));
    }

    public function test_that_we_cannot_set_data_in_a_cookie()
    {
        $cookie = new Cookie();
        $_COOKIE['test'] = 'test';

        $this->assertNull($cookie->save('test', 'test'));
    }

    public function test_that_we_can_get_data_from_a_cookie()
    {
        $_COOKIE['test'] = 'def5020092cfb5f8d38ad85015464a06b4dda08c9ef054be47946c3ee23023a0915e8326c9c458c03b58fc381b0a612fcf2396255135385cbaba7f2e12c8b73b6c34f4c6027acc424cf7da6d0680b3657dcc8b91ac7f1738';

        $cookie = new Cookie();
        $this->assertEquals('test', $cookie->get('test'));
    }

    public function test_that_we_cannot_get_data_from_a_cookie()
    {
        $cookie = new Cookie();

        $this->assertEmpty($cookie->get('non_existing_item'));
    }

    /**
     * @runInSeparateProcess
     */
    public function test_that_we_can_unset_data_from_a_cookie()
    {
        $cookie = new Cookie();
        $_COOKIE['test'] = 'test';

        $this->assertNull($cookie->unset('test'));
    }

    public function test_that_we_cannot_unset_data_from_a_cookie()
    {
        $cookie = new Cookie();

        $this->assertNull($cookie->unset('non_existing_item'));
    }
}
