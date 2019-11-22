<?php
declare(strict_types=1);


namespace App\Controllers\Admin;

use App\Models\admin\Page;
use App\Services\Helpers\DataTable;
use App\Src\Translation\Translation;
use App\Src\View\View;

final class PageController
{
    /**
     * @var Page
     */
    private $page;

    public function __construct()
    {
        $this->page = new Page();
    }

    public function index(): View
    {
        $title = Translation::get('admin_page_title');
        $pages = $this->page->getAll();

        $dataTable = new DataTable();
        $dataTable->addHead(
            'page_slug_ID',
            'page_title',
            'page_in_menu'
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
