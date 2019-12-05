<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Accounts\User\Actions;


use App\Models\Admin\Account;
use App\Models\User;
use App\Src\Action\Action;
use App\Src\Core\Request;
use App\Src\Security\CSRF;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

class UpdateUserPasswordAction extends Action
{
    private Session $session;
    private User $user;

    private string $currentPassword;
    private string $newPassword;
    private string $confirmationPassword;

    public function __construct(User $user)
    {
        $request = new Request();
        $this->session = new Session();
        $this->user = $user;

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
        $this->user->update($this->user->getID(), [
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
    protected function authorize(): bool
    {
        if (!CSRF::validate()) {
            return false;
        }

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
            $this->user->getAccount()->account_password ?? ''
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
