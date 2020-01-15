<?php
declare(strict_types=1);


namespace App\Domain\Admin\Accounts\Account\Actions;

use App\Domain\Admin\Accounts\Account\Models\Account;
use App\Domain\Admin\Accounts\Repositories\AccountRepository;
use App\Src\Action\FormAction;
use App\Src\Core\Request;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use App\Src\Validate\form\FormValidator;

final class UpdateAccountPasswordAction extends FormAction
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
                Account::PASSWORD_HASH_METHOD
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
    protected function validate(): bool
    {
        $validator = new FormValidator();
        $account = new AccountRepository(
            $this->account->find($this->account->getID())
        );

        $validator->input($this->password, 'Wachtwoord')
            ->isRequired()
            ->passwordIsEqual($this->confirmationPassword)
            ->passwordIsNotCurrentPassword($account->getPassword());

        return $validator->handleFormValidation();
    }
}
