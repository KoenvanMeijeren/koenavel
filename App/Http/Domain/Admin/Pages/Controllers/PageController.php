<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Pages\Controllers;

use App\Http\Domain\Admin\Pages\Actions\CreatePageAction;
use App\Http\Domain\Admin\Pages\Actions\DeletePageAction;
use App\Http\Domain\Admin\Pages\Actions\UpdatePageAction;
use App\Http\Domain\Admin\Pages\ViewModels\EditViewModel;
use App\Http\Domain\Admin\Pages\ViewModels\IndexViewModel;
use App\Http\Domain\Repositories\PageRepository;
use App\Models\Admin\Page;
use App\Src\Response\Redirect;
use App\Src\Translation\Translation;
use App\Src\View\DomainView;

final class PageController
{
    private Page $page;

    private string $baseViewPath = 'Admin/Pages/Views/';
    private string $redirectBack = '/admin/pages';

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

    public function create(): DomainView
    {
        return new DomainView(
            $this->baseViewPath . 'edit',
            [
                'title' => Translation::get('admin_create_page_title')
            ]
        );
    }

    /**
     * @return Redirect|DomainView
     */
    public function store()
    {
        $create = new CreatePageAction($this->page);
        if ($create->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->create();
    }

    public function edit(): DomainView
    {
        $page = new EditViewModel(
            $this->page->getBySlug($this->page->getSlug())
        );
        $page = new PageRepository($page->get());

        return new DomainView(
            $this->baseViewPath . 'edit',
            [
                'title' => sprintf(
                    Translation::get('admin_edit_page_title'),
                    $page->getSlug()
                ),
                'page' => $this->page->getBySlug($this->page->getSlug())
            ]
        );
    }

    /**
     * @return Redirect|DomainView
     */
    public function update()
    {
        $update = new UpdatePageAction($this->page);
        if ($update->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->edit();
    }

    public function destroy(): Redirect
    {
        $delete = new DeletePageAction($this->page);
        $delete->execute();

        return new Redirect($this->redirectBack);
    }
}
