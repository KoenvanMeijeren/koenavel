<?php
declare(strict_types=1);


namespace App\Models\Admin\Account;

use App\Models\User;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class UpdateAccount extends Account
{
    public function saveData(): bool
    {
        if ($this->validateData()) {
            $this->prepareData();
            $this->setIDFilter();

            parent::save();

            return true;
        }

        return false;
    }

    private function prepareData(): void
    {
        $this->setFields([
            'account_name' => $this->name,
            'account_rights' => (string) $this->rights,
        ]);
    }

    private function validateData(): bool
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

        if ($this->id === $this->user->getID()
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

    public function saveEmail(): bool
    {
        if ($this->validateEmail()) {
            $this->prepareEmail();
            $this->setIDFilter();

            parent::save();

            return true;
        }

        return false;
    }

    private function prepareEmail(): void
    {
        $this->setFields([
            'account_email' => $this->email,
        ]);
    }

    private function validateEmail(): bool
    {
        if (empty($this->email)) {
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

    public function savePassword(): bool
    {
        if ($this->validatePassword()) {
            $this->preparePassword();
            $this->setIDFilter();

            parent::save();

            return true;
        }

        return false;
    }

    private function preparePassword(): void
    {
        $this->setFields([
            'account_password' => (string) password_hash(
                $this->password,
                PASSWORD_ARGON2ID
            ),
        ]);
    }

    private function validatePassword(): bool
    {
        if (empty($this->password)
            || empty($this->confirmationPassword)
        ) {
            $this->session->flash(
                State::FAILED,
                Translation::get('form_message_for_required_fields')
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

        return true;
    }
}
