<?php
declare(strict_types=1);


namespace App\Services\Config;


use App\Services\Core\Config;
use App\Services\Core\Env;
use App\Services\Exceptions\Basic\AppIsNotConfiguredException;
use App\Services\Exceptions\Basic\InvalidKeyException;
use App\Services\Exceptions\File\FileNotExistingException;

class ConfigLoader
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
    public function __construct(string $env)
    {
        $this->configLocation = CONFIG_PATH . '/production_config.php';
        if (Env::DEVELOPMENT === $env) {
            $this->configLocation = CONFIG_PATH . '/dev_config.php';
        }
    }

    /**
     * Load the config items.
     *
     * @throws FileNotExistingException
     */
    public function load(): void
    {
        loadFile($this->configLocation);
    }

    /**
     * Check if the config is configured.
     *
     * @return void
     * @throws AppIsNotConfiguredException
     */
    public function checkConfigState(): void
    {
        if ($this->isConfigured()) {
            return;
        }

        throw new AppIsNotConfiguredException(
            'The app must be configured if you want to use it.'
        );
    }

    /**
     * Determine if the app has been configured.
     *
     * @return bool
     */
    private function isConfigured(): bool
    {
        try {
            Config::get('appName');

            return true;
        } catch (InvalidKeyException $e) {
            return false;
        }
    }
}
