<?php
declare(strict_types=1);


namespace App\services\security;

use App\services\core\Config;
use App\services\validate\Validate;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Exception;

class Encrypt
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
     *
     * @throws Exception
     */
    public function __construct(string $data)
    {
        Validate::var($data)->isString()->isNotEmpty();
        $this->data = $data;
    }

    /**
     * Encrypt the data.
     *
     * @return string
     *
     * @throws Exception
     */
    public function encrypt(): string
    {
        return Crypto::encrypt($this->data, $this->loadKeyFromConfig());
    }

    /**
     * Decrypt the data.
     *
     * @return string
     *
     * @throws Exception
     */
    public function decrypt(): string
    {
        return Crypto::decrypt($this->data, $this->loadKeyFromConfig());
    }

    /**
     * Load the key from the config.
     *
     * @return Key
     *
     * @throws Exception
     */
    private function loadKeyFromConfig(): Key
    {
        return Key::loadFromAsciiSafeString(Config::get('encryptionToken'));
    }
}
