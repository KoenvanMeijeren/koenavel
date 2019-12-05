<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Authorization\Actions;

use App\Models\User;
use App\Src\Action\Action;
use App\Src\Session\Builder;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class LogUserOutAction extends Action
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user =  $user;
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $builder = new Builder();
        $builder->destroy();
        $builder->startSession();
        $builder->setSessionSecurity();

        $session = new Session();
        $session->flash(
            State::SUCCESSFUL,
            Translation::get('admin_logout_message')
        );

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
        if (!$this->user->isLoggedIn()) {
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
