<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Accounts\User\Actions;

use App\Models\User;
use App\Src\Action\FormAction;
use App\Src\Core\Request;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class UpdateUserDataAction extends FormAction
{
    private Session $session;
    private User $user;

    private string $name;

    public function __construct(User $user)
    {
        $request = new Request();
        $this->session = new Session();
        $this->user = $user;

        $this->name = $request->post('name');
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->user->update($this->user->getID(), [
            'account_name' => $this->name
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
        if (empty($this->name)) {
            $this->session->flash(
                State::FAILED,
                Translation::get('form_message_for_required_fields')
            );
            return false;
        }

        return true;
    }
}
