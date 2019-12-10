<?php
declare(strict_types=1);


namespace App\Http\Domain\Pages\Controllers;

use App\Src\Translation\Translation;
use App\Src\View\DomainView;

final class PageController
{
    private string $baseViewPath = 'Pages/Views/';

    public function index(): DomainView
    {
        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('home_page_title')
            ]
        );
    }

    public function notFound(): DomainView
    {
        return new DomainView(
            $this->baseViewPath . '404',
            [
                'title' => Translation::get('page_not_found_title')
            ]
        );
    }
}
