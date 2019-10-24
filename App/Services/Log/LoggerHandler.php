<?php
declare(strict_types=1);


namespace App\Services\Log;

use Throwable;
use Whoops\Handler\Handler;

class LoggerHandler extends Handler
{
    public function handle()
    {
        $log = new Log();
        $log->addError($this->buildStringException($this->getException()));

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
            if (isset($singleTrace['line']) && !empty($singleTrace['line'])) {
                $error .= " on line {$singleTrace['line']}";
            }

            if (isset($singleTrace['file']) && !empty($singleTrace['file'])) {
                $error .= " in file {$singleTrace['file']}";
            }

            if (isset($singleTrace['function']) && !empty($singleTrace['function'])) {
                $error .= " in function {$singleTrace['function']} ";
            }

            if (isset($singleTrace['class']) && !empty($singleTrace['class'])) {
                $error .= " in class {$singleTrace['class']} ";
            }

            $trace++;
        }

        return $error;
    }
}
