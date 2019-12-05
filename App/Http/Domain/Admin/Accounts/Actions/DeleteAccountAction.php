<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Accounts\Actions;


use App\Models\Admin\Account;
use App\Models\User;
use App\Src\Action\Action;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

class DeleteAccountAction extends Action
{
    private Account $account;
    private Session $session;
    private User $user;

    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->session = new Session();
        $this->user = new User();
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->account->delete($this->account->getID());

        if (empty((array) $this->account->find($this->account->getID()))) {
            $this->session->flash(
                State::SUCCESSFUL,
                Translation::get('admin_deleted_account_successful_message')
            );
            return true;
        }

        $this->session->flash(
            State::FAILED,
            Translation::get('admin_deleted_account_failed_message')
        );
        return false;
    }

    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        if ($this->user->getID() === $this->account->getID()) {
            $this->session->flash(
                State::FAILED,
                Translation::get('cannot_delete_own_account_message')
            );
            return false;
        }

        return true;
    }
}
