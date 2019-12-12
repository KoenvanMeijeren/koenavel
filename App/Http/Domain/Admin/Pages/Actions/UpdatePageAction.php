<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Pages\Actions;

use App\Models\Admin\Page;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class UpdatePageAction extends PageAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->page->update($this->id, [
            'page_slug_ID' => (string) $this->slugId,
            'page_title' => $this->title,
            'page_content' => $this->content,
            'page_in_menu' => (string) $this->inMenu
        ]);

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('page_successfully_updated'),
                $this->url
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
                    Translation::get('page_static_cannot_be_edited'),
                    $this->pageRepository->getSlug()
                )
            );
            return false;
        }

        return parent::authorize();
    }
}
