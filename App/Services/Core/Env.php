<?php
declare(strict_types=1);


namespace App\Services\Core;

use App\Services\Exceptions\Basic\DuplicatedKeyException;
use App\Services\Exceptions\Basic\InvalidConfigException;
use App\Services\Exceptions\Uri\InvalidEnvException;
use App\Services\Validate\Validate;
use Exception;
use PDO;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

/**
 * Class Env
 *
 * @package App\services\core
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

        // temporary fix for scrutinizer-ci.com
        if (!file_exists($this->configLocation)) {
            $this->setDevelopmentConfig();
        } else {
            loadFile($this->configLocation);
        }


        if (!Config::isPrepared()) {
            throw new InvalidConfigException(
                'The config must be prepared before setting the error handling.'
            );
        }
    }

    /**
     * Set the error handling
     *
     * @return void
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

    /**
     * Temporary fix for development config.
     *
     * @return void
     * @throws DuplicatedKeyException
     */
    private function setDevelopmentConfig(): void
    {
        // APP NAME
        Config::set('appName', 'CC Westeinde');

        // SET LOCALE DATE
        setlocale(LC_TIME, 'NL_nl');
        setlocale(LC_ALL, 'nl_NL');
        date_default_timezone_set('Europe/Amsterdam');

        // DATABASE
        Config::set('databaseName', 'ccwesteinde');
        Config::set('databaseUsername', 'root');
        Config::set('databasePassword', '');
        Config::set('databaseServer', 'mysql:host=localhost');
        Config::set('databasePort', '3306');
        Config::set('databaseCharset', 'utf8');
        Config::set(
            'databaseOptions',
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        // MAXIMUM NUMBER OF LOG IN ATTEMPTS
        Config::set('loginAttempts', 3);

        // GOOGLE RECAPTCHA KEYS
        Config::set(
            'recaptcha_public_key',
            '6LeNC5YUAAAAAFnTMZ0jsov-0eYFa_9khig5djvo'
        );
        Config::set(
            'recaptcha_secret_key',
            '6LeNC5YUAAAAAIZcmuHccr8-bqOh1oQOPoR8pht1'
        );

        // TINY MCE KEY
        Config::set(
            'tinyMceKey',
            'amyz5vlo9d4hlbop0b78rh9earl2dxn0ljxerv4vuyfcqawj'
        );

        // ENCRYPTION TOKEN
        Config::set(
            'encryptionToken',
            'def00000bf6a79439be74b32d34b4c00dcb528a02f654b34472d1ca02383fc0284804eaa8404d6d0af3c41f7651d7f5d424af236f0daee2eea3704d00af9b1f68b31317b'
        );

        // SECRET KEY TOKEN
        Config::set(
            'secretKey',
            'ed0e050350bf9a35a201f4216d097a75f40eed9d18194ab3e4c9083a2d5496d909030c23ecf09bf3f58408a37639ea5186fb73e9fc101ac2e1b91746d704af5bfcbe456bf2bc74e12c2d4cf51498593f601ec034e9ad0733587e839b55089eb64137430f126dc8878a66470f7db3fe24f724e7ad3f10ecf745d7fd3c741d834e2010ae6b0858f21f0f4da6832eb6b26d0c403e3a634116528173f794158482d271f27e09e9c0a9160aa8361d49547e827941325a89a9c0903bcb01c39acaec6cb86b24a6a5a9b523'
        );

        // APP IS PREPARED
        Config::setPreparedState();
    }
}
