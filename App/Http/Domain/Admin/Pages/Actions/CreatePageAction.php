<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Pages\Actions;

use App\Src\State\State;
use App\Src\Translation\Translation;

final class CreatePageAction extends PageAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->page->create([
            'page_slug_ID' => (string) $this->getSlugId(),
            'page_title' => $this->title,
            'page_content' => $this->content,
            'page_in_menu' => (string) $this->inMenu
        ]);

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
