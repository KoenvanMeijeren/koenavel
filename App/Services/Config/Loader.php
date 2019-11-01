<?php
declare(strict_types=1);


namespace App\Services\Config;

use App\Services\Core\Env;
use App\Services\Exceptions\File\FileNotFoundException;

class Loader
{
    /**
     * The config file location of the app.
     *
     * @var string
     */
    private $configLocation;

    /**
     * Construct the config loader.
     *
     * @param string $env the env which will be used to determine
     *                    which config items must be loaded
     */
    protected function __construct(string $env)
    {
        $this->configLocation = CONFIG_PATH . '/production_config.php';
        if (Env::DEVELOPMENT === $env) {
            $this->configLocation = CONFIG_PATH . '/dev_config.php';
        }
    }

    /**
     * Load the config items.
     *
     * @return string[]
     * @throws FileNotFoundException
     */
    protected function loadConfig(): array
    {
        return loadFile($this->configLocation);
    }
}
