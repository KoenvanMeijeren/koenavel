<?php
declare(strict_types=1);


namespace App\Controllers\Admin;


use App\Models\admin\account\user\UpdateUser;
use App\Models\User;
use App\Src\Response\Redirect;
use App\Src\Translation\Translation;
use App\Src\View\View;

class UserAccountController
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
        $this->account = $this->user->getAccount();
    }

    public function index(): View
    {
        $title = Translation::get('admin_account_title');
        $account = $this->user->get();

        return new View(
            'admin/account/user/index',
            compact('title', 'account')
        );
    }

    public function storeData()
    {
        $title = Translation::get('admin_account_title');
        $account = $this->user->get();

        $updateUser = new UpdateUser($this->user);
        if ($updateUser->saveData()) {
            return new Redirect('/admin/user/account');
        }

        return new View(
            'admin/account/user/index',
            compact('title', 'account')
        );
    }

    public function storePassword()
    {
        $title = Translation::get('admin_account_title');
        $account = $this->user->get();

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
