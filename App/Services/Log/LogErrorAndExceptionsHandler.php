<?php
declare(strict_types=1);


namespace App\Services\Log;


use Whoops\Handler\Handler;

class LogErrorAndExceptionsHandler extends Handler
{
    public function handle()
    {
        $log = new Log();
        $log->error(
            $this->getException()->getMessage()
        );

        return Handler::DONE;
    }
}
