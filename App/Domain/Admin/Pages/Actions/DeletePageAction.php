<?php
declare(strict_types=1);


namespace App\Domain\Admin\Pages\Actions;

use App\Domain\Admin\Pages\Models\Page;
use App\Domain\Repositories\PageRepository;
use App\Src\Action\FormAction;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class DeletePageAction extends FormAction
{
    private Page $page;
    private PageRepository $pageRepository;
    private Session $session;

    public function __construct(Page $page)
    {
        $this->page = $page;
        $this->session = new Session();
        $this->pageRepository = new PageRepository($page->find($page->getID()));
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->page->delete($this->page->getID());

        if ($this->page->find($this->page->getID()) !== null) {
            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('page_unsuccessfully_deleted'),
                    $this->pageRepository->getSlug()
                )
            );

            return false;
        }

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('page_successfully_deleted'),
                $this->pageRepository->getSlug()
            )
        );

        return true;
    }

    protected function authorize(): bool
    {
        if ($this->pageRepository->getInMenu() === Page::PAGE_STATIC) {
            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('page_static_cannot_be_deleted'),
                    $this->pageRepository->getSlug()
                )
            );
            return false;
        }

        return parent::authorize();
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        return true;
    }
}
