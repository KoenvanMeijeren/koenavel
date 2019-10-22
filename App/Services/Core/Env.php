<?php
declare(strict_types=1);


namespace App\Services\Core;

use App\Services\Exceptions\Uri\InvalidEnvException;
use App\Services\Validate\Validate;
use App\Services\View\ProductionErrorView;
use Exception;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

/**
 * Class Env
 *
 * @package App\Services\Core
 *
 * TODO: rewrite sensitive config data to .env files
 */
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
    private $env = '';

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
        $request = new Request();

        $this->host = $request->server(Request::HTTP_HOST);
        Validate::var($this->host)->isDomain();
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
     */
    public function setEnv(): void
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

        $logger = new Log();
        $logger->debug("$this->env env has been set.");
    }

    /**
     * Set the error handling
     *
     * @return void
     * @throws Exception
     */
    public function setErrorHandling(): void
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

        $logger = new Log();
        $logger->debug('Error handling has been set.');
    }
}
