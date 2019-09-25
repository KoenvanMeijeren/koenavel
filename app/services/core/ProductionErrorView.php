<?php
declare(strict_types=1);


namespace App\services\core;

use Exception;
use Whoops\Handler\Handler;

class ProductionErrorView extends Handler
{
    /**
     * @return int|null A handler may return nothing, or a Handler::HANDLE_* constant
     *
     * @throws Exception
     */
    public function handle()
    {
        new View('500-error');

        return Handler::QUIT;
    }
}
