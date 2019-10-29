<?php
declare(strict_types=1);


namespace App\Services\Log;

use App\Services\Config\Config;
use App\Services\Core\Env;
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
        $config = new Config();
        $env = new Env();

        $format = "[%datetime%] %level_name% %message% %context% %extra%\n";
        $timeFormat = "Y-m-d H:i:s";
        $dateTimeZone = new \DateTimeZone('Europe/Amsterdam');

        $this->logger = new Logger($config->get('appName')->toString());
        $this->logger->setTimezone($dateTimeZone);

        $this->logger->pushProcessor(new IntrospectionProcessor());
        $this->logger->pushProcessor(new ProcessIdProcessor());

        $formatter = new LineFormatter($format, $timeFormat);
        $formatter->ignoreEmptyContextAndExtra();

        $level = $env->getEnv() === Env::DEVELOPMENT ?
            Logger::DEBUG : Logger::INFO;
        $defaultHandler = new RotatingFileHandler(
            START_PATH . '/storage/logs/app.log',
            365,
            $level
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
    public function addDebug(string $message, array $context = []): void
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
    public function addInfo(string $message, array $context = []): void
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
    public function addError(string $message, array $context = []): void
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
    public function addAppRequest(
        string $value,
        string $state,
        string $url,
        string $method
    ): void {
        $message = "{$method} request for page {$url} with message {$value}";

        $this->addInfo($state . " " . $message);
    }
}
