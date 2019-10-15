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
    private static $logger;

    /**
     * Construct the logger.
     *
     * @throws Exception
     */
    private function __construct()
    {
        self::$logger = new Logger(Config::get('appName')->toString());
        self::$logger->pushHandler(
            new RotatingFileHandler(
                START_PATH . '/storage/logs/app.log',
                365,
                Logger::DEBUG
            )
        );
        self::$logger->pushHandler(new FirePHPHandler());
        self::$logger->pushProcessor(new WebProcessor());
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
    public static function get(string $date): string
    {
        new static();

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
    public static function info(string $message, array $context = []): void
    {
        new static();
        self::$logger->info($message, $context);
    }

    /**
     * Log error info.
     *
     * @param string  $message the log message
     * @param mixed[] $context the log context
     *
     * @throws Exception
     */
    public static function error(string $message, array $context = []): void
    {
        new static();
        self::$logger->error($message, $context);
    }

    /**
     * Log the app request.
     *
     * @param string $state specify the key if you want to add a state
     * @param string $value the message
     *
     * @throws Exception
     */
    public static function appRequest(
        string $value = '',
        string $state = 'successful'
    ): void {
        $message = URI::method();
        $message .= ' request for page ';
        $message .= URI::getUrl();
        $message .= ' with message "';
        $message .= $value;
        $message .= '"';

        Log::info($state . " " . $message);
    }
}
