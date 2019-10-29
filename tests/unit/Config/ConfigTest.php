<?php
declare(strict_types=1);


use App\Services\Exceptions\Basic\InvalidKeyException;

class ConfigTest extends \PHPUnit\Framework\TestCase
{
    public function test_that_we_can_get_an_item()
    {
        $config = new App\Services\Config\Config();

        $this->assertNotEmpty($config->get('appName')->toString());
        $this->assertIsString($config->get('appName')->toString());
    }

    public function test_that_we_cannot_get_an_item()
    {
        $this->expectException(InvalidKeyException::class);

        $config = new App\Services\Config\Config();

        $config->get('non_existing_item');
    }
}
