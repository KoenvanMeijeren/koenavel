<?php
declare(strict_types=1);


namespace App\Controllers;

use App\Src\Exceptions\File\FileNotFoundException;
use App\Src\View\View;

class PageController
{
    /**
     * Show the index page.
     *
     * @return View
     * @throws FileNotFoundException
     */
    public function index(): View
    {
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
        return new View('404');
    }
}
