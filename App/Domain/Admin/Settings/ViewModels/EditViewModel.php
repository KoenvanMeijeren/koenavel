<?php
declare(strict_types=1);


namespace App\Domain\Admin\Settings\ViewModels;


use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Response\Redirect;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use stdClass;

final class EditViewModel
{
    private ?object $setting;
    private Session $session;

    public function __construct(?object $setting)
    {
        $this->setting = $setting;
        $this->session = new Session();
    }

    /**
     * @return Redirect|stdClass
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function get()
    {
        if ($this->setting === null) {
            $this->session->flash(
                State::FAILED,
                Translation::get('setting_does_not_exists')
            );

            return new Redirect('/admin/settings');
        }

        return $this->setting;
    }
}
