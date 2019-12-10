<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Pages\ViewModels;

use App\Http\Domain\Repositories\PageRepository;
use App\Services\Helpers\DataTable;

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
            'Slug ID',
            'Titel',
            'Tonen in menu?'
        );

        foreach ($this->pages as $singlePage) {
            $page = new PageRepository($singlePage);

            $this->dataTable->addRow(
                $page->getId(),
                $page->getTitle(),
                $page->getInMenu()
            );
        }

        return $this->dataTable->get();
    }
}
