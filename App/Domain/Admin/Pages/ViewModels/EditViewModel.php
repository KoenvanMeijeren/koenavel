<?php
declare(strict_types=1);


namespace App\Domain\Admin\Pages\ViewModels;

use App\Domain\Admin\Pages\Models\Page;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Response\Redirect;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use stdClass;

final class EditViewModel
{
    private ?stdClass $page;
    private Session $session;

    public function __construct(?stdClass $page)
    {
        $this->page = $page;
        $this->session = new Session();
    }

    /**
     * @return Redirect|stdClass
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function get()
    {
        if ($this->page === null) {
            $page = new Page();

            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('admin_page_cannot_be_visited'),
                    $page->getSlug()
                )
            );

            return new Redirect('/admin/pages');
        }

        return $this->page;
    }
}
