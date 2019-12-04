<?php
declare(strict_types=1);


namespace App\Controllers\Admin;

use App\Models\Admin\Account\Account;
use App\Models\Admin\Account\CreateAccount;
use App\Models\Admin\Account\UpdateAccount;
use App\Models\User;
use App\Services\Helpers\Converter;
use App\Services\Helpers\DataTable;
use App\Services\Helpers\Resource;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Response\Redirect;
use App\Src\Security\CSRF;
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
     * @param string $title
     *
     * @return Redirect|View
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function show(string $title = 'admin_edit_account_title')
    {
        $title = Translation::get($title);
        $account = $this->account->find($this->account->getID());

        if ($account === false) {
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
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function store()
    {
        $title = Translation::get('admin_create_account_title');

        $create = new CreateAccount();
        if (CSRF::validate() && $create->execute()) {
            $this->session->flash(
                State::SUCCESSFUL,
                Translation::get('admin_create_account_successful_message')
            );

            return new Redirect('/admin/account');
        }

        return new View('admin/account/create', compact('title'));
    }

    /**
     * @return Redirect|View
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function storeData()
    {
        $account = new UpdateAccount();
        if (CSRF::validate() && $account->saveData()) {
            $this->session->flash(
                State::SUCCESSFUL,
                Translation::get('admin_edited_account_successful_message')
            );

            return new Redirect(
                '/admin/account/edit/' . $this->account->getID()
            );
        }

        return $this->show('admin_create_account_title');
    }

    /**
     * @return Redirect|View
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function storeEmail()
    {
        $account = new UpdateAccount();
        if (CSRF::validate() && $account->saveEmail()) {
            $this->session->flash(
                State::SUCCESSFUL,
                Translation::get('admin_edited_account_successful_message')
            );

            return new Redirect(
                '/admin/account/edit/' . $this->account->getID()
            );
        }

        return $this->show('admin_edit_account_title');
    }

    /**
     * @return Redirect|View
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function storePassword()
    {
        $account = new UpdateAccount();
        if (CSRF::validate() && $account->savePassword()) {
            $this->session->flash(
                State::SUCCESSFUL,
                Translation::get('admin_edited_account_successful_message')
            );

            return new Redirect(
                '/admin/account/edit/' . $this->account->getID()
            );
        }

        return $this->show('admin_edit_account_title');
    }

    public function block(): Redirect
    {
        if ($this->account->block($this->account->getID())) {
            $this->session->flash(
                State::SUCCESSFUL,
                Translation::get('admin_account_successful_blocked_message')
            );
        }

        return new Redirect(
            '/admin/account/edit/' . $this->account->getID()
        );
    }

    public function unblock(): Redirect
    {
        if ($this->account->unblock($this->account->getID())) {
            $this->session->flash(
                State::SUCCESSFUL,
                Translation::get('admin_account_successful_unblocked_message')
            );
        }

        return new Redirect(
            '/admin/account/edit/' . $this->account->getID()
        );
    }

    public function destroy(): Redirect
    {
        if ($this->account->delete($this->account->getID())) {
            $this->session->flash(
                State::SUCCESSFUL,
                Translation::get('admin_deleted_account_successful_message')
            );
        }

        return new Redirect('/admin/account');
    }
}
