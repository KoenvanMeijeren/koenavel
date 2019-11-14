<?php
declare(strict_types=1);


namespace App\Controllers;

use App\Src\Translation\Translation;
use App\Src\View\View;

final class PageController
{
    public function index(): View
    {
        $title = Translation::get('home_page_title');

        return new View('index/index', compact('title'));
    }

    public function expiredSession(): View
    {
        $title = Translation::get('page_expired_title');

        return new View('http/419', compact('title'));
    }

    public function notFound(): View
    {
        $title = Translation::get('page_not_found_title');

        return new View('http/404', compact('title'));
    }
}
