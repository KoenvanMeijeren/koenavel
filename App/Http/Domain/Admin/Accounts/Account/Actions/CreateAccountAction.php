<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Accounts\Account\Actions;

use App\Models\Admin\Account;
use App\Models\User;
use App\Src\Action\FormAction;
use App\Src\Core\Request;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use App\Src\Validate\form\FormValidator;

final class CreateAccountAction extends FormAction
{
    private Account $account;
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
        $this->rights = (int)$request->post('rights');
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->account->create([
            'account_name' => $this->name,
            'account_email' => $this->email,
            'account_password' => (string)password_hash(
                $this->password,
                Account::PASSWORD_ENCRYPTION
            ),
            'account_rights' => (string)$this->rights,
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
    protected function validate(): bool
    {
        $validator = new FormValidator();

        $validator->input($this->name, 'Naam')
            ->isRequired();

        $validator->input($this->email, 'Email')
            ->isRequired()
            ->isEmail()
            ->isUnique(
                $this->account->getByEmail($this->email),
                sprintf(
                    Translation::get('admin_email_already_exists_message'),
                    $this->email
                )
            );

        $validator->input($this->password, 'Wachtwoord')
            ->isRequired()
            ->passwordIsEqual($this->confirmationPassword);

        $validator->input((string)$this->rights, 'Rechten')
            ->isRequired()
            ->isBetweenRange(
                User::ADMIN,
                User::DEVELOPER,
                Translation::get('admin_invalid_rights_message')
            );

        return $validator->handleFormValidation();
    }
}
