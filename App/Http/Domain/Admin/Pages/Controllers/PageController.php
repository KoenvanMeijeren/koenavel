<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Pages\Controllers;

use App\Models\Admin\Page;
use App\Services\Helpers\DataTable;
use App\Src\Translation\Translation;
use App\Src\View\View;

final class PageController
{
    private Page $page;

    public function __construct()
    {
        $this->page = new Page();
    }

    public function index(): View
    {
        $title = Translation::get('admin_page_title');
        $pages = $this->page->all();

        $dataTable = new DataTable();
        $dataTable->addHead(
            'Slug ID',
            'Titel',
            'Tonen in menu?'
        );

        foreach ($pages as $page) {
            $dataTable->addRow(
                $page->page_slug_ID ?? '0',
                $page->page_title ?? 'Undefined',
                $page->page_in_menu ?? '0'
            );
        }

        $pages = $dataTable->get();

        return new View(
            'admin/page/index',
            compact('title', 'pages')
        );
    }
}
