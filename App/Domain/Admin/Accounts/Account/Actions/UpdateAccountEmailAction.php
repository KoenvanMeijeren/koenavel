<?php
declare(strict_types=1);


namespace App\Domain\Admin\Accounts\Account\Actions;

use App\Domain\Admin\Accounts\Account\Models\Account;
use App\Src\Action\FormAction;
use App\Src\Core\Request;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use App\Src\Validate\form\FormValidator;

final class UpdateAccountEmailAction extends FormAction
{
    private Account $account;
    private Session $session;

    protected string $email;

    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->session = new Session();
        $request = new Request();

        $this->email = $request->post('email');
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->account->update($this->account->getID(), [
            'account_email' => $this->email,
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

        $validator->input($this->email, 'Email')
            ->isEmail()
            ->isUnique(
                $this->account->getByEmail($this->email),
                sprintf(
                    Translation::get('admin_email_already_exists_message'),
                    $this->email
                )
            );

        return $validator->handleFormValidation();
    }
}
