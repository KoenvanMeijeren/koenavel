<?php
declare(strict_types=1);


namespace App\Domain\Admin\Pages\Actions;

use App\Domain\Admin\Pages\Models\Page;
use App\Domain\Admin\Pages\Repositories\PageRepository;
use App\Src\Action\FormAction;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class PublishPageAction extends FormAction
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
        $this->page->update($this->pageRepository->getId(), [
            'page_is_published' => '1'
        ]);

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('page_successfully_published'),
                $this->pageRepository->getSlug()
            )
        );

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
        if ($this->pageRepository->getInMenu() === Page::PAGE_STATIC) {
            $this->session->flash(
                State::FAILED,
                Translation::get('page_static_cannot_be_published')
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
