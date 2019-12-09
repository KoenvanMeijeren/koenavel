<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Accounts\User\Controllers;

use App\Http\Domain\Admin\Accounts\User\Actions\UpdateUserDataAction;
use App\Http\Domain\Admin\Accounts\User\Actions\UpdateUserPasswordAction;
use App\Models\User;
use App\Src\Response\Redirect;
use App\Src\Translation\Translation;
use App\Src\View\View;

final class UserAccountController
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(): View
    {
        $title = Translation::get('admin_account_title');
        $account = $this->user->getAccount();

        return new View(
            'admin/account/user/index',
            compact('title', 'account')
        );
    }

    /**
     * @return Redirect|View
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
     * @return Redirect|View
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
