<?php
declare(strict_types=1);


namespace App\Models\Admin\Account\User;

use App\Models\User;
use App\Src\Core\Request;
use App\Src\Model\BaseModel;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class UpdateUser extends BaseModel
{
    /**
     * @var int
     */
    const MINIMUM_PASSWORD_LENGTH = 8;
    const MAXIMUM_NAME_LENGTH = 255;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Session
     */
    private $session;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $currentPassword;

    /**
     * @var string
     */
    private $newPassword;

    /**
     * @var string
     */
    private $confirmationPassword;

    public function __construct(User $user)
    {
        $request = new Request();
        $this->session = new Session();

        $this->user = $user;
        $this->name = $request->post('name');
        $this->currentPassword = $request->post('currentPassword');
        $this->newPassword = $request->post('newPassword');
        $this->confirmationPassword = $request->post(
            'confirmationPassword'
        );

        $this->table = 'account';
    }

    public function saveData(): bool
    {
        if ($this->validateData()) {
            $this->setFields([
                'account_name' => $this->name
            ]);

            $this->store();

            $this->session->flash(
                State::SUCCESSFUL,
                Translation::get('admin_edited_account_successful_message')
            );
            return true;
        }

        return false;
    }

    private function validateData(): bool
    {
        if (empty($this->name)) {
            $this->session->flash(
                State::FAILED,
                Translation::get('form_message_for_required_fields')
            );
            return false;
        }

        if (strlen($this->name) <= 1) {
            $this->session->flash(
                State::FAILED,
                'Naam moet minimaal 1 teken bevatten.'
            );

            return false;
        }

        if (strlen($this->name) > self::MAXIMUM_NAME_LENGTH) {
            $this->session->flash(
                State::FAILED,
                'Naam mag maximaal 255 teken bevatten.'
            );

            return false;
        }

        return true;
    }

    public function savePassword(): bool
    {
        if ($this->validatePassword()) {
            $this->setFields([
                'account_password' => (string) password_hash(
                    $this->newPassword,
                    PASSWORD_BCRYPT
                )
            ]);

            $this->store();

            $this->session->flash(
                State::SUCCESSFUL,
                Translation::get('admin_edited_account_successful_message')
            );
            return true;
        }

        return false;
    }

    private function validatePassword(): bool
    {
        if (empty($this->currentPassword)
            || empty($this->newPassword)
            || empty($this->confirmationPassword)
        ) {
            $this->session->flash(
                State::FAILED,
                Translation::get('form_message_for_required_fields')
            );

            return false;
        }

        if (!password_verify(
            $this->currentPassword,
            $this->user->get()->account_password ?? ''
        )) {
            $this->session->flash(
                State::FAILED,
                Translation::get('admin_edit_account_wrong_current_password_message')
            );

            return false;
        }

        if ($this->newPassword !== $this->confirmationPassword) {
            $this->session->flash(
                State::FAILED,
                Translation::get('admin_passwords_are_not_the_same_message')
            );

            return false;
        }

        if (strlen($this->newPassword) < self::MINIMUM_PASSWORD_LENGTH) {
            $this->session->flash(
                State::FAILED,
                'Het nieuwe wachtwoord moet minimaal 8 tekens bevatten.'
            );
            return false;
        }

        return true;
    }

    private function store(): void
    {
        $this->setFilter(
            'account_ID',
            '=',
            (string)$this->user->getID()
        );
        $this->setFilter(
            'account_is_deleted',
            '=',
            '0'
        );

        $this->save();
    }
}
