<?php declare(strict_types=1);


use App\services\Core\Config;
use App\services\Session\Session;
use PHPUnit\Framework\TestCase;

class SessionTest extends TestCase
{
    /**
     * The session class
     *
     * @var Session
     */
    private $session;

    public function setUp(): void
    {
        Config::set('encryptionToken',
            'def00000bf6a79439be74b32d34b4c00dcb528a02f654b34472d1ca02383fc0284804eaa8404d6d0af3c41f7651d7f5d424af236f0daee2eea3704d00af9b1f68b31317b'
        );
        Config::set('appName', 'TestApp');

        $this->session = new Session();
    }

    public function test_that_we_can_set_up_the_session()
    {
        $this->assertInstanceOf(
            Session::class,
            new Session()
        );
    }

    public function test_that_we_can_get_data_from_the_session()
    {
        $this->session->save('test', 'test');
        $this->session->save('error', 'test');
        $this->session->save('success', 'test');

        $this->assertEquals('test', $this->session->get('test'));
        $this->assertEquals('test', $this->session->get('error'));
        $this->assertEquals('test', $this->session->get('success'));

        unset($_SESSION['test']);
        unset($_SESSION['error']);
        unset($_SESSION['success']);
    }

    public function test_that_we_cannot_get_duplicated_data_from_the_session()
    {
        $this->session->save('test', 'test');
        $this->session->save('test', 'test2');

        $this->assertNotEquals(
            'test2',
            $this->session->get('test')
        );

        unset($_SESSION['test']);
    }

    public function test_that_we_cannot_get_data_from_the_session()
    {
        $this->assertEmpty(
            $this->session->get('test_non_existing_item')
        );
    }

    public function test_that_we_can_save_data_forced_into_the_session()
    {
        $this->session->save('test', 'test');
        $this->session->saveForced('test', 'test2');

        $this->assertNotEquals(
            'test',
            $this->session->get('test2')
        );

        unset($_SESSION['test']);
    }

    public function test_that_we_can_unset_data_from_the_session()
    {
        $this->session->save('test', 'test');
        $this->assertNotEmpty($this->session->get('test'));

        $this->session->unset('test');
        $this->assertEmpty($this->session->get('test'));

        $this->session->save('test', 'test');
        $this->assertNotEmpty($this->session->get('test', true));
        $this->assertEmpty($this->session->get('test'));
    }

    public function test_that_we_can_flash_data_into_the_session()
    {
        $this->session->flash('test', 'test');

        $this->assertEquals(
            'test',
            $this->session->get('test')
        );

        $this->session->unset('test');
    }

    public function tearDown(): void
    {
        Config::unset('encryptionToken');
        Config::unset('appName');
    }
}
