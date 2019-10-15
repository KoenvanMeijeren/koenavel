<?php
declare(strict_types=1);


namespace App\Controllers;

use App\services\Core\View;

class PageController
{
    public function index(): View
    {
        return new View('index');
    }

    public function notFound(): View
    {
        return new View('404');
    }
}
