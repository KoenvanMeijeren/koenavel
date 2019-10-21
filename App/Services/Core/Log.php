<?php
declare(strict_types=1);


namespace App\Services\Core;

use Exception;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Processor\WebProcessor;

final class Log
{
    /**
     * The logger object.
     *
     * @var Logger
     */
    private $logger;

    /**
     * Construct the logger.
     *
     * @throws Exception
     */
    public function __construct()
    {
        $this->logger = new Logger(Config::get('appName')->toString());
        $this->logger->pushHandler(
            new RotatingFileHandler(
                START_PATH . '/storage/logs/app.log',
                365,
                Logger::DEBUG
            )
        );

        $this->logger->pushHandler(new FirePHPHandler());
        $this->logger->pushProcessor(new WebProcessor());
    }

    /**
     * Get data from a specific log.
     *
     * @param string $date the date to get log data from.
     *
     * @return string
     *
     * @throws Exception
     */
    public function get(string $date): string
    {
        return (string) file_get_contents(
            START_PATH . '/storage/logs/app-' .
            $date . '.log'
        );
    }

    /**
     * Log info.
     *
     * @param string  $message the log message
     * @param mixed[] $context the log context
     *
     * @throws Exception
     */
    public function info(string $message, array $context = []): void
    {
        $this->logger->info($message, $context);
    }

    /**
     * Log error info.
     *
     * @param string  $message the log message
     * @param mixed[] $context the log context
     *
     * @throws Exception
     */
    public function error(string $message, array $context = []): void
    {
        $this->logger->error($message, $context);
    }

    /**
     * Log the request from the user for the application.
     *
     * @param string $state specify the key if you want to add a state
     * @param string $value the message
     * @param string $url the url which the user is viewing
     * @param string $method the used method to access the uri
     *
     * @throws Exception
     */
    public function appRequest(
        string $value,
        string $state,
        string $url,
        string $method
    ): void {
        $message = "{$method} request for page {$url} with message {$value}";

        $this->logger->info($state . " " . $message);
    }
}
