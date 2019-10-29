<?php
declare(strict_types=1);


use App\Services\Security\Encrypt;
use PHPUnit\Framework\TestCase;

class EncryptTest extends TestCase
{
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
}
