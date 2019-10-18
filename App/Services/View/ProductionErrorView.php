<?php
declare(strict_types=1);


namespace App\Services\View;

use Exception;
use Whoops\Handler\Handler;

class ProductionErrorView extends Handler
{
    /**
     * Show the error page when the app is in production mode
     *
     * @param string $viewName The name of the production error view
     *
     * @return int A handler may return nothing, or a Handler::HANDLE_* constant
     *
     * @throws Exception
     */
    public function handle(string $viewName = '500-error'): int
    {
        new View($viewName);

        return Handler::QUIT;
    }
}
