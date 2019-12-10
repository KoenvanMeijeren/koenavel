<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Pages\Controllers;

use App\Http\Domain\Admin\Pages\ViewModels\IndexViewModel;
use App\Models\Admin\Page;
use App\Src\Translation\Translation;
use App\Src\View\DomainView;

final class PageController
{
    private Page $page;

    private string $baseViewPath = 'Admin/Pages/Views/';

    public function __construct()
    {
        $this->page = new Page();
    }

    public function index(): DomainView
    {
        $pages = new IndexViewModel($this->page->all());

        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('admin_page_title'),
                'pages' => $pages->table()
            ]
        );
    }
}
