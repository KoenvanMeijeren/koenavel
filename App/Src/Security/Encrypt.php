<?php
declare(strict_types=1);


namespace App\Src\Security;

use App\Src\Config\Config;
use App\Src\Exceptions\Basic\InvalidKeyException;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Exception\BadFormatException;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;
use Defuse\Crypto\Key;

final class Encrypt
{
    /**
     * The data to be encrypted or decrypted.
     *
     * @var string
     */
    private $data;

    /**
     * Construct the data.
     *
     * @param string $data the data to be saved
     */
    public function __construct(string $data)
    {
        $this->data = $data;
    }


    /**
     * Encrypt data.
     *
     * @return string
     * @throws BadFormatException
     * @throws EnvironmentIsBrokenException
     * @throws InvalidKeyException
     */
    public function encrypt(): string
    {
        return Crypto::encrypt($this->data, $this->loadKeyFromConfig());
    }


    /**
     * Decrypt encrypted data.
     *
     * @return string
     * @throws BadFormatException
     * @throws EnvironmentIsBrokenException
     * @throws InvalidKeyException
     * @throws WrongKeyOrModifiedCiphertextException
     */
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
