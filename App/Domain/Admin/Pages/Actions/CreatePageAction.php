<?php
declare(strict_types=1);


namespace App\Domain\Admin\Pages\Actions;

use App\Domain\Admin\Pages\Models\Page;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class CreatePageAction extends PageAction
{
    private array $attributes = [];

    private function prepare(): void
    {
        $this->attributes = [
            'page_slug_ID' => (string) $this->getSlugId(),
            'page_title' => $this->title,
            'page_content' => $this->content,
            'page_in_menu' => (string) $this->inMenu
        ];

        if ($this->inMenu === Page::PAGE_STATIC) {
            $this->attributes['page_is_published'] = '1';
        }
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->prepare();

        $this->page->create($this->attributes);

        if ($this->page->getBySlug($this->url) === null) {
            $this->session->flash(
                State::FAILED,
                Translation::get('page_unsuccessfully_created')
            );

            return false;
        }

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('page_successfully_created'),
                $this->url
            )
        );

        return true;
    }
}
