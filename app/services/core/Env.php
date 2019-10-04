<?php
declare(strict_types=1);


namespace App\services\core;

use App\services\exceptions\basic\InvalidConfigException;
use App\services\exceptions\uri\InvalidEnvException;
use App\services\validate\Validate;
use Exception;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

final class Env
{
    /**
     * The environment options.
     *
     * @var string
     */
    const DEVELOPMENT = 'development';
    const PRODUCTION = 'production';

    /**
     * The host of the app.
     *
     * @var string
     */
    private $host;

    /**
     * The env of the app.
     *
     * @var string
     */
    private $env;

    /**
     * The config file location of the app.
     *
     * @var string
     */
    private $configLocation;

    /**
     * Construct the env.
     *
     * Set the live url, host and set the env.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->host = URI::getHost();
        Validate::var($this->host)->isDomain();

        $this->setEnv();
        $this->setErrorHandling();
    }

    /**
     * Get the env
     *
     * @return string
     */
    public function getEnv(): string
    {
        return $this->env;
    }

    /**
     * Set the current env based on the uri.
     *
     * @throws Exception
     * @throws InvalidEnvException
     * @throws InvalidConfigException
     */
    private function setEnv(): void
    {
        $this->env = self::PRODUCTION;
        $this->configLocation = CONFIG_PATH . '/production_config.php';
        if (strstr($this->host, 'localhost')
            || strstr($this->host, '127.0.0.1')
        ) {
            $this->env = self::DEVELOPMENT;
            $this->configLocation = CONFIG_PATH . '/dev_config.php';
        }

        Validate::var($this->env)->isEnv();
        Config::set('env', $this->env);

        loadFile($this->configLocation);

        if (!Config::isPrepared()) {
            throw new InvalidConfigException(
                'The config must be prepared before setting the error handling.'
            );
        }
    }

    /**
     * Set the error handling
     */
    private function setErrorHandling(): void
    {
        ini_set(
            'display_errors',
            (self::DEVELOPMENT === $this->env ? '1' : '0')
        );
        ini_set(
            'display_startup_errors',
            (self::DEVELOPMENT === $this->env ? '1' : '0')
        );
        error_reporting((self::DEVELOPMENT === $this->env ? E_ALL : (int)-1));

        $whoops = new Whoops();

        if (self::DEVELOPMENT === $this->env) {
            $whoops->prependHandler(new PrettyPageHandler());
            $whoops->register();

            return;
        }

        $whoops->prependHandler(new ProductionErrorView());
        $whoops->register();
    }
}
