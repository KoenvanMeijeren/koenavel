<?php
declare(strict_types=1);


namespace App\Src\Security;

use App\Src\Config\Config;
use App\Src\Exceptions\Basic\InvalidKeyException;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Exception\BadFormatException;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Key;

final class Encrypt
{
    private string $data;

    /**
     * Construct the data.
     *
     * @param string $data the data to be saved
     */
    public function __construct(string $data)
    {
        $this->data = $data;
    }


    public function encrypt(): string
    {
        return Crypto::encrypt($this->data, $this->loadKeyFromConfig());
    }

    public function decrypt(): string
    {
        return Crypto::decrypt($this->data, $this->loadKeyFromConfig());
    }

    /**
     * Load the key from the config.
     *
     * @return Key
     * @throws InvalidKeyException
     * @throws BadFormatException
     * @throws EnvironmentIsBrokenException
     */
    private function loadKeyFromConfig(): Key
    {
        $config = new Config();

        return Key::loadFromAsciiSafeString(
            $config->get('encryptionToken')->toString()
        );
    }
}
