<?php
declare(strict_types=1);


namespace App\Src\Core;

use App\Src\Exceptions\Uri\InvalidDomainException;
use App\Src\Exceptions\Uri\InvalidEnvException;
use App\Src\Log\LoggerHandler;
use App\Src\Validate\Validate;
use App\Src\View\ProductionErrorView;
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
     * The default error page.
     *
     * @var string
     */
    const ERROR_PAGE = 'http/500-error';

    private string $host;
    private string $env = '';

    /**
     * Construct the env.
     *
     * Set the live url, host and set the env.
     *
     * @throws InvalidDomainException
     * @throws InvalidEnvException
     */
    public function __construct()
    {
        $request = new Request();

        $host = $request->server(Request::HTTP_HOST);
        $this->host = $host !== '' ? $host : 'localhost';
        Validate::var($this->host)->isDomain();

        $this->setEnv();
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
     * Set the error handling
     *
     * @return void
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
        error_reporting((self::DEVELOPMENT === $this->env ? E_ALL : -1));

        $this->initializeWhoops();
    }

    /**
     * Set the current env based on the uri.
     *
     * @throws InvalidEnvException
     */
    private function setEnv(): void
    {
        $this->env = self::PRODUCTION;
        if (strstr($this->host, 'localhost') !== false ||
            strstr($this->host, '127.0.0.1') !== false
        ) {
            $this->env = self::DEVELOPMENT;
        }

        Validate::var($this->env)->isEnv();
    }

    /**
     * Initialize the whoops error and exception handler.
     */
    private function initializeWhoops(): void
    {
        $whoops = new Whoops();
        if (self::DEVELOPMENT === $this->env) {
            $whoops->prependHandler(new PrettyPageHandler());
            $whoops->register();
        } elseif (self::PRODUCTION === $this->env) {
            $whoops->prependHandler(new ProductionErrorView());
            $whoops->register();
        }

        $whoops->prependHandler(new LoggerHandler());
        $whoops->register();
    }
}
