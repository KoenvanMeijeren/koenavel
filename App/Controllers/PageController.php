<?php
declare(strict_types=1);


namespace App\Controllers;

use App\Src\Database\DB;
use App\Src\Exceptions\File\FileNotFoundException;
use App\Src\View\View;

final class PageController
{
    /**
     * Show the index page.
     *
     * @return View
     * @throws FileNotFoundException
     */
    public function index(): View
    {
        dd(
            DB::table('account')
                ->select('*')->execute()->all()
        );
        return new View('index');
    }

    /**
     * Route not found.
     *
     * @return View
     * @throws FileNotFoundException
     */
    public function notFound(): View
    {
        return new View('http/404');
    }
}
