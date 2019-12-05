<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Accounts\Account\Actions;

use App\Models\Admin\Account;
use App\Models\User;
use App\Src\Action\Action;
use App\Src\Core\Request;
use App\Src\Security\CSRF;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

class CreateAccountAction extends Action
{
    private ?Account $account;
    private Session $session;

    protected string $name;
    protected string $email;
    protected string $password;
    protected string $confirmationPassword;
    protected int $rights;

    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->session = new Session();
        $request = new Request();

        $this->name = $request->post('name');
        $this->email = $request->post('email');
        $this->password = $request->post('password');
        $this->confirmationPassword = $request->post('confirmationPassword');
        $this->rights = (int) $request->post('rights');
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->account->create([
            'account_name' => $this->name,
            'account_email' => $this->email,
            'account_password' => (string) password_hash(
                $this->password,
                PASSWORD_ARGON2ID
            ),
            'account_rights' => (string) $this->rights,
        ]);

        $this->session->flash(
            State::SUCCESSFUL,
            Translation::get('admin_create_account_successful_message')
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
        if (empty($this->name)
            || empty($this->email)
            || empty($this->password)
            || empty($this->confirmationPassword)
            || empty($this->rights)
        ) {
            $this->session->flash(
                State::FAILED,
                Translation::get('form_message_for_required_fields')
            );

            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('form_invalid_email_message'),
                    $this->email
                )
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

        if ($this->rights !== User::ADMIN
            && $this->rights !== User::SUPER_ADMIN
            && $this->rights !== User::DEVELOPER
        ) {
            $this->session->flash(
                State::FAILED,
                Translation::get('admin_invalid_rights_message')
            );

            return false;
        }

        if (!empty((array) $this->account->getByEmail($this->email))) {
            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('admin_email_already_exists_message'),
                    $this->email
                )
            );

            return false;
        }

        return true;
    }
}
