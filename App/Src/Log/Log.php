<?php
declare(strict_types=1);


namespace App\Src\Log;

use App\Src\Core\Env;
use App\Src\Core\Request;
use App\Src\File\File;
use DateTimeZone;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\FirePHPHandler;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Processor\WebProcessor;

final class Log
{
    private static Logger $logger;

    private function __construct()
    {
        $request = new Request();
        $env = new Env();

        $format = "[%datetime%] %level_name% %message% %context% %extra%\n";
        $timeFormat = 'Y-m-d H:i:s';
        $dateTimeZone = new DateTimeZone('Europe/Amsterdam');

        self::$logger = new Logger($request->env('appName'));
        self::$logger->setTimezone($dateTimeZone);

        self::$logger->pushProcessor(new IntrospectionProcessor());
        self::$logger->pushProcessor(new ProcessIdProcessor());

        $formatter = new LineFormatter($format, $timeFormat);
        $formatter->ignoreEmptyContextAndExtra();

        $level = $env->get() === Env::DEVELOPMENT ?
            Logger::DEBUG : Logger::INFO;
        $defaultHandler = new RotatingFileHandler(
            START_PATH . '/storage/logs/app.log',
            365,
            $level
        );
        $defaultHandler->setFormatter($formatter);

        self::$logger->pushHandler($defaultHandler);
        self::$logger->pushHandler(new FirePHPHandler());
        self::$logger->pushProcessor(new WebProcessor());
    }

    /**
     * Get data from a specific log.
     *
     * @param string $date the date to get log data from.
     *
     * @return string
     */
    public static function get(string $date): string
    {
        new self();

        $file = new File(
            STORAGE_PATH . '/logs/',
            'app-' . $date . '.log'
        );

        return $file->get();
    }

    /**
     * Log debug info.
     *
     * @param string  $message the log message
     * @param mixed[] $context the log context
     */
    public static function debug(string $message, array $context = []): void
    {
        new self();

        self::$logger->debug($message, $context);
    }

    /**
     * Log info.
     *
     * @param string  $message the log message
     * @param mixed[] $context the log context
     */
    public static function info(string $message, array $context = []): void
    {
        new self();

        self::$logger->info($message, $context);
    }

    /**
     * Log warning info.
     *
     * @param string  $message the log message
     * @param mixed[] $context the log context
     */
    public static function warning(string $message, array $context = []): void
    {
        new self();

        self::$logger->warning($message, $context);
    }

    /**
     * Log error info.
     *
     * @param string  $message the log message
     * @param mixed[] $context the log context
     */
    public static function error(string $message, array $context = []): void
    {
        new self();

        self::$logger->error($message, $context);
    }

    /**
     * Log the request from the user for the application.
     *
     * @param string $state     specify the key if you want to add a state
     * @param string $value     the message
     * @param string $url       the url which the user is viewing
     * @param string $method    the used method to access the uri
     */
    public static function appRequest(
        string $value,
        string $state,
        string $url,
        string $method
    ): void {
        new self();

        $message = "{$method} request for page {$url} with message {$value}";
        if ($value === '') {
            $message = "{$method} request for page {$url}";
        }

        self::info($state . ' ' . $message);
    }
}
