<?php
declare(strict_types=1);


namespace App\Domain\Admin\Accounts\Account\Actions;

use App\Domain\Admin\Accounts\Account\Models\Account;
use App\Domain\Admin\Accounts\User\Models\User;
use App\Src\Action\Action;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class UnblockAccountAction extends Action
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
        $this->account->update($this->account->getID(), [
            'account_is_blocked' => '0'
        ]);

        $this->session->flash(
            State::SUCCESSFUL,
            Translation::get('admin_account_successful_unblocked_message')
        );
        return true;
    }

    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
        if ($this->user->getID() === $this->account->getID()) {
            $this->session->flash(
                State::FAILED,
                Translation::get('cannot_unblock_own_account_message')
            );
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        return true;
    }
}
