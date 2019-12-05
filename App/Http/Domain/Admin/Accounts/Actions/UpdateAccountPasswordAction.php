<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Accounts\Actions;


use App\Models\Admin\Account;
use App\Src\Action\Action;
use App\Src\Core\Request;
use App\Src\Security\CSRF;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class UpdateAccountPasswordAction extends Action
{
    private Account $account;
    private Session $session;

    protected string $password;
    protected string $confirmationPassword;

    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->session = new Session();
        $request = new Request();

        $this->password = $request->post('password');
        $this->confirmationPassword = $request->post('confirmationPassword');
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->account->update($this->account->getID(), [
            'account_password' => (string) password_hash(
                $this->password,
                Account::PASSWORD_ENCRYPTION
            ),
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
        if (empty($this->password)
            || empty($this->confirmationPassword)
        ) {
            $this->session->flash(
                State::FAILED,
                Translation::get('form_message_for_required_fields')
            );

            return false;
        }

        if ($this->password !== $this->confirmationPassword) {
            $this->session->flash(
                State::FAILED,
                Translation::get('admin_passwords_are_not_the_same_message')
            );

            return false;
        }

        return true;
    }
}
