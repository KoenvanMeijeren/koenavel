<?php
declare(strict_types=1);


namespace App\Src\Log;

use Throwable;
use Whoops\Handler\Handler;

final class LoggerHandler extends Handler
{
    public function handle()
    {
        Log::error($this->buildStringException($this->getException()));

        return Handler::DONE;
    }

    /**
     * Convert the exception into html.
     *
     * @param Throwable $exception the exception to be prepared for the log
     *
     * @return string
     */
    private function buildStringException(Throwable $exception): string
    {
        $error = "Exception: {$exception->getMessage()}";
        $error .= " on line {$exception->getLine()}";
        $error .= " in file {$exception->getFile()}";
        $error .= " in code {$exception->getCode()}";
        $error .= $this->buildStackTrace($exception);

        return $error;
    }

    /**
     * Build the stack trace of the error.
     *
     * @param Throwable $exception this is going to be prepared for the log
     *
     * @return string
     */
    private function buildStackTrace(Throwable $exception): string
    {
        $trace = 0;
        $error = '';

        foreach ($exception->getTrace() as $singleTrace) {
            if (array_key_exists('line', $singleTrace)) {
                $error .= " on line {$singleTrace['line']}";
            }

            if (array_key_exists('file', $singleTrace)) {
                $error .= " in file {$singleTrace['file']}";
            }

            if (array_key_exists('function', $singleTrace)) {
                $error .= " in function {$singleTrace['function']} ";
            }

            if (array_key_exists('class', $singleTrace)) {
                $error .= " in class {$singleTrace['class']} ";
            }

            $trace++;
        }

        return $error;
    }
}
