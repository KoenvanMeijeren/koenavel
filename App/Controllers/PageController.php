<?php
declare(strict_types=1);


namespace App\Controllers;

use App\Src\Database\DB;
use App\Src\View\View;

final class PageController
{
    /**
     * Show the index page.
     *
     * @return View
     */
    public function index(): View
    {
        $accounts = DB::table('account')
                ->select('*')->execute()->all();

        return new View('index/index', compact('accounts'));
    }

    /**
     * Route not found.
     *
     * @return View
     */
    public function notFound(): View
    {
        $title = '404 page';

        return new View('http/404', compact('title'));
    }
}
