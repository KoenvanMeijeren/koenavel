<?php
declare(strict_types=1);


namespace App\Services\Config;

use App\Services\Core\Env;
use App\Services\Exceptions\Basic\InvalidKeyException;
use App\Services\Exceptions\File\FileNotExistingException;
use App\Services\Type\TypeChanger;

final class Config extends ConfigLoader
{
    /**
     * The config items.
     *
     * @var array
     */
    private $config = [];

    /**
     * Construct the config items.
     *
     * @throws FileNotExistingException
     */
    public function __construct()
    {
        $env = new Env();

        parent::__construct($env->getEnv());

        $this->config += $this->loadConfig();
    }

    /**
     * Get a config item.
     *
     * @param string $key the key to search for the corresponding value
     *
     * @return TypeChanger
     *
     * @throws InvalidKeyException
     */
    public function get(string $key): TypeChanger
    {
        if (!isset($this->config[$key])) {
            throw new InvalidKeyException(
                "There is no existing config item with key: {$key}"
            );
        }

        return new TypeChanger($this->config[$key]);
    }
}
