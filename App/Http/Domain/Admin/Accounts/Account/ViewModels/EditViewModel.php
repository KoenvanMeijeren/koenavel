<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Accounts\Account\ViewModels;

use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Response\Redirect;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use stdClass;

final class EditViewModel
{
    private ?stdClass $account;
    private Session $session;

    public function __construct(?stdClass $account)
    {
        $this->account = $account;
        $this->session = new Session();
    }

    /**
     * @return Redirect|stdClass
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function get()
    {
        if ($this->account === null) {
            $this->session->flash(
                State::FAILED,
                Translation::get('admin_account_cannot_be_visited')
            );

            return new Redirect('/admin/account');
        }

        return $this->account;
    }
}
