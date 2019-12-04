<?php
declare(strict_types=1);


namespace App\Controllers\Admin;

use App\Actions\Account\User\UpdateUserDataAction;
use App\Actions\Account\User\UpdateUserPasswordAction;
use App\Models\User;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Response\Redirect;
use App\Src\Translation\Translation;
use App\Src\View\View;
use stdClass;

final class UserAccountController
{
    private User $user;
    private stdClass $account;

    public function __construct()
    {
        $this->user = new User();
        $this->account = $this->user->getAccount();
    }

    /**
     * Show the edit page for the user.
     *
     * @return View
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function index(): View
    {
        $title = Translation::get('admin_account_title');
        $account = $this->account;

        return new View(
            'admin/account/user/index',
            compact('title', 'account')
        );
    }

    /**
     * Store the data of the user.
     *
     * @return Redirect|View
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function storeData()
    {
        $updateUser = new UpdateUserDataAction($this->user);
        if ($updateUser->execute()) {
            return new Redirect('/admin/user/account');
        }

        return $this->index();
    }

    /**
     * Store the new password of the user.
     *
     * @return Redirect|View
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function storePassword()
    {
        $updateUser = new UpdateUserPasswordAction($this->user);
        if ($updateUser->execute()) {
            return new Redirect('/admin/user/account');
        }

        return $this->index();
    }
}
