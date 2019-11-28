<?php
declare(strict_types=1);


namespace App\Models\Admin\Account;

use App\Models\User;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class CreateAccount extends Account
{
    public function create(): bool
    {
        if (!$this->validate()) {
            return false;
        }

        $this->prepare();
        parent::create();

        return true;
    }

    private function prepare(): void
    {
        $this->setFields([
            'account_name' => $this->name,
            'account_email' => $this->email,
            'account_password' => (string) password_hash(
                $this->password,
                PASSWORD_ARGON2ID
            ),
            'account_rights' => (string) $this->rights,
        ]);
    }

    private function validate(): bool
    {
        if (empty($this->name)
            || empty($this->email)
            || empty($this->password)
            || empty($this->confirmationPassword)
            || empty($this->rights)
        ) {
            $this->session->flash(
                State::FAILED,
                Translation::get('form_message_for_required_fields')
            );

            return false;
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('form_invalid_email_message'),
                    $this->email
                )
            );

            return false;
        }

        if ($this->password !== $this->confirmationPassword) {
            $this->session->flash(
                State::FAILED,
                Translation::get('admin_passwords_are_not_the_same_message')
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

        if (!empty((array) $this->getByEmail($this->email))) {
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
