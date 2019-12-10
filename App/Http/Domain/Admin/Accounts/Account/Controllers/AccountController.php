<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Accounts\Account\Controllers;

use App\Http\Domain\Admin\Accounts\Account\Actions\BlockAccountAction;
use App\Http\Domain\Admin\Accounts\Account\Actions\CreateAccountAction;
use App\Http\Domain\Admin\Accounts\Account\Actions\DeleteAccountAction;
use App\Http\Domain\Admin\Accounts\Account\Actions\UnblockAccountAction;
use App\Http\Domain\Admin\Accounts\Account\Actions\UpdateAccountDataAction;
use App\Http\Domain\Admin\Accounts\Account\Actions\UpdateAccountEmailAction;
use App\Http\Domain\Admin\Accounts\Account\Actions\UpdateAccountPasswordAction;
use App\Http\Domain\Admin\Accounts\Account\ViewModels\EditViewModel;
use App\Http\Domain\Admin\Accounts\Account\ViewModels\IndexViewModel;
use App\Models\Admin\Account;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Response\Redirect;
use App\Src\Translation\Translation;
use App\Src\View\DomainView;

final class AccountController
{
    private Account $account;

    private string $baseViewPath = 'Admin/Accounts/Account/Views/';

    public function __construct()
    {
        $this->account = new Account();
    }

    public function index(): DomainView
    {
        $accounts = new IndexViewModel($this->account->all());

        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('admin_account_title'),
                'accounts' => $accounts->table()
            ]
        );
    }

    public function create(): DomainView
    {
        return new DomainView(
            $this->baseViewPath . 'create',
            [
                'title' => Translation::get('admin_create_account_title')
            ]
        );
    }

    /**
     * @return Redirect|DomainView
     */
    public function store()
    {
        $create = new CreateAccountAction($this->account);
        if ($create->execute()) {
            return new Redirect('/admin/account');
        }

        return $this->create();
    }

    /**
     * @param string $title
     *
     * @return Redirect|DomainView
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function edit(string $title = 'admin_edit_account_title')
    {
        $account = new EditViewModel(
            $this->account->find($this->account->getID())
        );

        return new DomainView(
            $this->baseViewPath . 'edit',
            [
                'title' => Translation::get($title),
                'account' => $account->get()
            ]
        );
    }

    /**
     * @return Redirect|DomainView
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function storeData()
    {
        $account = new UpdateAccountDataAction($this->account);
        if ($account->execute()) {
            return new Redirect(
                '/admin/account/edit/' . $this->account->getID()
            );
        }

        return $this->edit('admin_create_account_title');
    }

    /**
     * @return Redirect|DomainView
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function storeEmail()
    {
        $account = new UpdateAccountEmailAction($this->account);
        if ($account->execute()) {
            return new Redirect(
                '/admin/account/edit/' . $this->account->getID()
            );
        }

        return $this->edit('admin_edit_account_title');
    }

    /**
     * @return Redirect|DomainView
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function storePassword()
    {
        $account = new UpdateAccountPasswordAction($this->account);
        if ($account->execute()) {
            return new Redirect(
                '/admin/account/edit/' . $this->account->getID()
            );
        }

        return $this->edit('admin_edit_account_title');
    }

    public function block(): Redirect
    {
        $block = new BlockAccountAction($this->account);
        $block->execute();

        return new Redirect(
            '/admin/account/edit/' . $this->account->getID()
        );
    }

    public function unblock(): Redirect
    {
        $unblock = new UnblockAccountAction($this->account);
        $unblock->execute();

        return new Redirect(
            '/admin/account/edit/' . $this->account->getID()
        );
    }

    public function destroy(): Redirect
    {
        $delete = new DeleteAccountAction($this->account);
        $delete->execute();

        return new Redirect('/admin/account');
    }
}
