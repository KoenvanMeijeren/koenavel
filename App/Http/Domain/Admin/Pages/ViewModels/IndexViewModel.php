<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Pages\ViewModels;

use App\Http\Domain\Repositories\PageRepository;
use App\Services\Helpers\Converter;
use App\Services\Helpers\DataTable;
use App\Services\Helpers\Resource;
use App\Src\Translation\Translation;

final class IndexViewModel
{
    /**
     * @var object[]
     */
    private array $pages;

    private DataTable $dataTable;

    /**
     * @param object[] $pages
     */
    public function __construct(array $pages)
    {
        $this->pages = $pages;
        $this->dataTable = new DataTable();
    }

    public function table(): string
    {
        $this->dataTable->addHead(
            Translation::get('table_row_slug'),
            Translation::get('table_row_title'),
            Translation::get('table_row_page_in_menu'),
            Translation::get('table_row_edit'),
        );

        foreach ($this->pages as $singlePage) {
            $page = new PageRepository($singlePage);
            $converter = new Converter($page->getInMenu());

            $this->dataTable->addRow(
                '/' . $page->getSlug(),
                $page->getTitle(),
                $converter->toReadableMenuState(),
                Resource::addTableEditColumn(
                    '/admin/page/edit/' . $page->getSlug(),
                    '/admin/page/delete/' . $page->getId(),
                    Translation::get('delete_page_confirmation_message')
                )
            );
        }

        return $this->dataTable->get();
    }
}
