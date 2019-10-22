<?php
declare(strict_types=1);


namespace App\Services\Core;

use Exception;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\ProcessIdProcessor;
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
        $format = "[%datetime%] %level_name% %message% %context% %extra%\n";
        $timeFormat = "Y-m-d H:i:s";
        $dateTimeZone = new \DateTimeZone('Europe/Amsterdam');

        $this->logger = new Logger(Config::get('appName')->toString());
        $this->logger->setTimezone($dateTimeZone);

        $this->logger->pushProcessor(new IntrospectionProcessor());
        $this->logger->pushProcessor(new ProcessIdProcessor());

        $formatter = new LineFormatter($format, $timeFormat);
        $formatter->ignoreEmptyContextAndExtra();

        $level = Config::get('env')->toString() === Env::DEVELOPMENT ?
            Logger::DEBUG : Logger::INFO;
        $defaultHandler = new RotatingFileHandler(
            START_PATH . '/storage/logs/app.log',
            365, $level
        );
        $defaultHandler->setFormatter($formatter);

        $this->logger->pushHandler($defaultHandler);
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
     * Log debug info.
     *
     * @param string  $message the log message
     * @param mixed[] $context the log context
     *
     * @throws Exception
     */
    public function debug(string $message, array $context = []): void
    {
        $this->logger->debug($message, $context);
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
     * @param string $state     specify the key if you want to add a state
     * @param string $value     the message
     * @param string $url       the url which the user is viewing
     * @param string $method    the used method to access the uri
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

        $this->info($state . " " . $message);
    }
}
