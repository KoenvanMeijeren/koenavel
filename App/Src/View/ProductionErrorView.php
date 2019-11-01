<?php
declare(strict_types=1);


namespace App\Src\View;

use App\Src\Core\Env;
use Exception;
use Whoops\Handler\Handler;

final class ProductionErrorView extends Handler
{
    /**
     * Show the error page when the app is in production mode
     *
     * @return int A handler may return nothing,
     * or a Handler::HANDLE_* constant
     *
     * @throws Exception
     */
    public function handle(): int
    {
        new View(Env::ERROR_PAGE);

        return Handler::QUIT;
    }
}
