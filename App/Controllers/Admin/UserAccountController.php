<?php
declare(strict_types=1);


namespace App\Controllers\Admin;

use App\Models\admin\account\user\UpdateUser;
use App\Models\User;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Response\Redirect;
use App\Src\Translation\Translation;
use App\Src\View\View;

final class UserAccountController
{
    /**
     * @var User
     */
    private $user;

    /**
     * @var object
     */
    private $account;

    public function __construct()
    {
        $this->user = new User();
        $this->account = $this->user->get();
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
        $title = Translation::get('admin_account_title');
        $account = $this->account;

        $updateUser = new UpdateUser($this->user);
        if ($updateUser->saveData()) {
            return new Redirect('/admin/user/account');
        }

        return new View(
            'admin/account/user/index',
            compact('title', 'account')
        );
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
        $title = Translation::get('admin_account_title');
        $account = $this->account;

        $updateUser = new UpdateUser($this->user);
        if ($updateUser->savePassword()) {
            return new Redirect('/admin/user/account');
        }

        return new View(
            'admin/account/user/index',
            compact('title', 'account')
        );
    }
}
