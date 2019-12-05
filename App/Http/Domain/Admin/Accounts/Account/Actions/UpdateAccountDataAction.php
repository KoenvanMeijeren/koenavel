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

final class UpdateAccountDataAction extends Action
{
    private Account $account;
    private User $user;
    private Session $session;

    protected string $name;
    protected int $rights;

    public function __construct(Account $account)
    {
        $this->account = $account;
        $this->user = new User();
        $this->session = new Session();
        $request = new Request();

        $this->name = $request->post('name');
        $this->rights = (int) $request->post('rights');
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->account->update($this->account->getID(), [
            'account_name' => $this->name,
            'account_rights' => (string) $this->rights,
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

        if ($this->account->getID() === $this->user->getID()
            && $this->rights !== $this->user->getRights()
        ) {
            $this->session->flash(
                State::FAILED,
                Translation::get('cannot_edit_own_account_rights_message')
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
        if (empty($this->name)
            || empty($this->rights)
        ) {
            $this->session->flash(
                State::FAILED,
                Translation::get('form_message_for_required_fields')
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

        return true;
    }
}
