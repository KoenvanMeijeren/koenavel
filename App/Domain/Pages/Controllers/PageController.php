<?php
declare(strict_types=1);


namespace App\Domain\Pages\Controllers;

use App\Domain\Admin\Pages\Models\Page;
use App\Domain\Repositories\PageRepository;
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

    public function findOr404(): DomainView
    {
        $pageModel = new Page();

        $page = $pageModel->getBySlug($pageModel->getSlug());
        if ($page === null) {
            $page = $pageModel->getBySlug('pagina-niet-gevonden');
        }

        if ($page !== null) {
            return $this->show(new PageRepository($page));
        }

        return $this->notFound();
    }

    public function show(PageRepository $page): DomainView
    {
        return new DomainView(
            $this->baseViewPath . 'show',
            [
                'title' => $page->getTitle(),
                'pageContent' => $page->getContent()
            ]
        );
    }

    public function notFound(): DomainView
    {
        return new DomainView(
            $this->baseViewPath . '404',
            [
                'title' => Translation::get('page_not_found_title'),
                'content' => Translation::get('page_not_found_description')
            ]
        );
    }
}
