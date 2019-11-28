<?php
declare(strict_types=1);


namespace App\Src\Log;

use Throwable;
use Whoops\Handler\Handler;

final class LoggerHandler extends Handler
{
    /**
     * @var string
     */
    private $error;

    public function handle()
    {
        $this->buildStringException($this->getException());
        $this->buildStackTrace($this->getException());

        Log::error($this->error);
        return Handler::DONE;
    }

    /**
     * Convert the exception into html.
     *
     * @param Throwable $exception the exception to be prepared for the log
     */
    private function buildStringException(Throwable $exception): void
    {
        $this->error = "Exception: {$exception->getMessage()}";
        $this->error .= " on line {$exception->getLine()}";
        $this->error .= " in file {$exception->getFile()}";
        $this->error .= " in code {$exception->getCode()}";
    }

    /**
     * Build the stack trace of the error.
     *
     * @param Throwable $exception this is going to be prepared for the log
     */
    private function buildStackTrace(Throwable $exception): void
    {
        foreach($exception->getTrace() as $trace) {
            if (array_key_exists('line', $trace)) {
                $this->error .= " on line {$trace['line']}";
            }

            if (array_key_exists('file', $trace)) {
                $this->error .= " in file {$trace['file']}";
            }

            if (array_key_exists('function', $trace)) {
                $this->error .= " in function {$trace['function']} ";
            }

            if (array_key_exists('class', $trace)) {
                $this->error .= " in class {$trace['class']} ";
            }
        }
    }
}
