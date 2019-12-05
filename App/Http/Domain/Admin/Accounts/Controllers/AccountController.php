<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Accounts\Controllers;

use App\Http\Domain\Admin\Accounts\Actions\BlockAccountAction;
use App\Http\Domain\Admin\Accounts\Actions\CreateAccountAction;
use App\Http\Domain\Admin\Accounts\Actions\DeleteAccountAction;
use App\Http\Domain\Admin\Accounts\Actions\UnblockAccountAction;
use App\Http\Domain\Admin\Accounts\Actions\UpdateAccountDataAction;
use App\Http\Domain\Admin\Accounts\Actions\UpdateAccountEmailAction;
use App\Http\Domain\Admin\Accounts\Actions\UpdateAccountPasswordAction;
use App\Models\Admin\Account;
use App\Models\User;
use App\Services\Helpers\Converter;
use App\Services\Helpers\DataTable;
use App\Services\Helpers\Resource;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Response\Redirect;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use App\Src\View\View;

final class AccountController
{
    private Account $account;
    private Session $session;

    public function __construct()
    {
        $this->account = new Account();
        $this->session = new Session();
    }

    public function index(): View
    {
        $title = Translation::get('admin_account_title');

        $dataTable = new DataTable();
        $user = new User();
        $dataTable->addEditHead('Naam', 'Email', 'Rechten');

        $accounts = $this->account->all();
        foreach ($accounts as $account) {
            $rights = new Converter($account->account_rights ?? '0');
            $blocked = new Converter($account->account_is_blocked ?? '0');

            if ($blocked->toReadableBlockState() !== '') {
                $dataTable->addClasses('user-blocked');
            }

            $dataTable->addRow(
                ucfirst($account->account_name ?? '') . "{$blocked->toReadableBlockState()}",
                lcfirst($account->account_email ?? ''),
                $rights->toReadableRights(),
                Resource::addTableEditColumn(
                    '/admin/account/edit/' . ($account->account_ID ?? 0),
                    '/admin/account/delete/' . ($account->account_ID ?? 0),
                    Translation::get('admin_delete_account_warning_message'),
                    $user->getID() === (int)($account->account_ID ?? '0') ? true : false
                )
            );
        }
        $accounts = $dataTable->get();

        return new View(
            'admin/account/index',
            compact('title', 'accounts')
        );
    }

    public function create(): View
    {
        $title = Translation::get('admin_create_account_title');

        return new View('admin/account/create', compact('title'));
    }

    /**
     * @return Redirect|View
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
     * @return Redirect|View
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function edit(string $title = 'admin_edit_account_title')
    {
        $title = Translation::get($title);
        $account = $this->account->find($this->account->getID());

        if (empty((array) $account)) {
            $this->session->flash(
                State::FAILED,
                Translation::get('admin_account_cannot_be_visited')
            );

            return new Redirect('/admin/account');
        }

        return new View(
            'admin/account/edit',
            compact('title', 'account')
        );
    }

    /**
     * @return Redirect|View
     */
    public function storeData()
    {
        $account = new UpdateAccountDataAction($this->account);
        if ($account->execute()) {
            return new Redirect(
                '/admin/account/edit/' . $this->account->getID()
            );
        }

        return $this->show('admin_create_account_title');
    }

    /**
     * @return Redirect|View
     */
    public function storeEmail()
    {
        $account = new UpdateAccountEmailAction($this->account);
        if ($account->execute()) {
            return new Redirect(
                '/admin/account/edit/' . $this->account->getID()
            );
        }

        return $this->show('admin_edit_account_title');
    }

    /**
     * @return Redirect|View
     */
    public function storePassword()
    {
        $account = new UpdateAccountPasswordAction($this->account);
        if ($account->execute()) {
            return new Redirect(
                '/admin/account/edit/' . $this->account->getID()
            );
        }

        return $this->show('admin_edit_account_title');
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
