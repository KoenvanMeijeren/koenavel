<?php
declare(strict_types=1);


namespace App\Src\View;

use App\Src\Core\Env;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Translation\Translation;
use Whoops\Handler\Handler;

final class ProductionErrorView extends Handler
{
    /**
     * Show the error page when the app is in production mode
     *
     * @return int A handler may return nothing,
     * or a Handler::HANDLE_* constant
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function handle(): int
    {
        new View(Env::ERROR_PAGE, [
            'title' => Translation::get('internal_server_error_title'),
            'description' => Translation::get('internal_server_error_description')
        ]);

        return Handler::QUIT;
    }
}
