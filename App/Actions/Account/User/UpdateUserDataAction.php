<?php
declare(strict_types=1);


namespace App\Actions\Account\User;


use App\Models\User;
use App\Src\Action\Action;
use App\Src\Core\Request;
use App\Src\Security\CSRF;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class UpdateUserDataAction extends Action
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
    protected function handle(): void
    {
        $this->user->update($this->user->getID(), [
            'account_name' => $this->name
        ]);

        $this->session->flash(
            State::SUCCESSFUL,
            Translation::get('admin_edited_account_successful_message')
        );
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
