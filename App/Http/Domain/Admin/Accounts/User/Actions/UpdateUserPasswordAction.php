<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Accounts\User\Actions;

use App\Http\Domain\Repositories\AccountRepository;
use App\Models\Admin\Account;
use App\Models\User;
use App\Src\Action\FormAction;
use App\Src\Core\Request;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class UpdateUserPasswordAction extends FormAction
{
    private Session $session;
    private User $user;

    private string $currentPassword;
    private string $newPassword;
    private string $confirmationPassword;

    private AccountRepository $account;

    public function __construct(User $user)
    {
        $request = new Request();
        $this->session = new Session();

        $this->user = $user;
        $this->account = new AccountRepository($user->getAccount());

        $this->currentPassword = $request->post('currentPassword');
        $this->newPassword = $request->post('newPassword');
        $this->confirmationPassword = $request->post(
            'confirmationPassword'
        );
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->user->update($this->account->getId(), [
            'account_password' =>  (string) password_hash(
                $this->newPassword,
                Account::PASSWORD_ENCRYPTION
            )
        ]);

        $this->session->flash(
            State::SUCCESSFUL,
            Translation::get('admin_edited_account_successful_message')
        );

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        if (empty($this->currentPassword)
            || empty($this->newPassword)
            || empty($this->confirmationPassword)
        ) {
            $this->session->flash(
                State::FAILED,
                Translation::get('form_message_for_required_fields')
            );

            return false;
        }

        if (!password_verify(
            $this->currentPassword,
            $this->account->getPassword()
        )) {
            $this->session->flash(
                State::FAILED,
                Translation::get('admin_edit_account_wrong_current_password_message')
            );

            return false;
        }

        if ($this->newPassword !== $this->confirmationPassword) {
            $this->session->flash(
                State::FAILED,
                Translation::get('admin_passwords_are_not_the_same_message')
            );

            return false;
        }

        return true;
    }
}
