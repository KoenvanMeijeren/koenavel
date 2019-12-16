<?php
declare(strict_types=1);


namespace App\Domain\Admin\Accounts\User\Controllers;

use App\Domain\Admin\Accounts\User\Actions\UpdateUserDataAction;
use App\Domain\Admin\Accounts\User\Actions\UpdateUserPasswordAction;
use App\Domain\Admin\Accounts\User\Models\User;
use App\Src\Response\Redirect;
use App\Src\Translation\Translation;
use App\Src\View\DomainView;

final class UserAccountController
{
    private User $user;

    private string $baseViewPath = 'Admin/Accounts/User/Views/';

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(): DomainView
    {
        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('admin_account_title'),
                'account' => $this->user->getAccount()
            ]
        );
    }

    /**
     * @return Redirect|DomainView
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
     * @return Redirect|DomainView
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
