<?php
declare(strict_types=1);


namespace App\Src\Config;

use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Type\TypeChanger;

abstract class Loader
{
    /**
     * The config file location of the app.
     *
     * @var string
     */
    protected string $configLocation;

    /**
     * Construct the config loader.
     */
    abstract public function __construct();

    /**
     * Get a config item.
     *
     * @param string $key the key to search for the corresponding value
     *
     * @return TypeChanger
     * @throws InvalidKeyException
     */
    abstract public function get(string $key): TypeChanger;

    /**
     * Load the config items.
     *
     * @return string[]
     */
    final protected function loadConfig(): array
    {
        return includeFile($this->configLocation);
    }
}
