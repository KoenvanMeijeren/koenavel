<?php
declare(strict_types=1);


use App\services\Core\Config;
use App\services\Security\Encrypt;
use PHPUnit\Framework\TestCase;

class EncryptTest extends TestCase
{
    public function setUp(): void
    {
        // ENCRYPTION TOKEN
        Config::set(
            'encryptionToken',
            'def00000bf6a79439be74b32d34b4c00dcb528a02f654b34472d1ca02383fc0284804eaa8404d6d0af3c41f7651d7f5d424af236f0daee2eea3704d00af9b1f68b31317b'
        );
    }

    public function test_that_i_can_encrypt_data()
    {
        $data = 'test';
        $encrypt = new Encrypt($data);

        $this->assertNotEquals($data, $encrypt->encrypt());
    }

    public function test_that_i_can_decrypt_data()
    {
        $encrypt = new Encrypt('test');
        $data = $encrypt->encrypt();

        $encrypt = new Encrypt($data);
        $this->assertEquals('test', $encrypt->decrypt());
    }

    public function tearDown(): void
    {
        Config::unset('encryptionToken');
    }
}
