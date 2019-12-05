<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Accounts\Account\Actions;

use App\Models\Admin\Account;
use App\Src\Action\Action;
use App\Src\Core\Request;
use App\Src\Security\CSRF;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class UpdateAccountEmailAction extends Action
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
        if (empty($this->email)) {
            $this->session->flash(
                State::FAILED,
                Translation::get('form_message_for_required_fields')
            );

            return false;
        }

        if (! (bool) filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('form_invalid_email_message'),
                    $this->email
                )
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
