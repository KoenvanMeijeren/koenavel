<?php
declare(strict_types=1);


namespace App\Src\Config;

use App\Src\Core\Env;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\File\FileNotFoundException;
use App\Src\Type\TypeChanger;

final class Config extends Loader
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
     * @throws FileNotFoundException
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
