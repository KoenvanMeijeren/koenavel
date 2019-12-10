<?php
declare(strict_types=1);


namespace App\Src\Validate\form;

use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class FormValidator
{
    private string $input;
    private string $alias;

    /**
     * @var string[]
     */
    private array $errors = [];

    public function input(string $input, string $alias = ''): FormValidator
    {
        $this->input = $input;
        $this->alias = $alias;

        return $this;
    }

    public function isRequired(): FormValidator
    {
        if ($this->input === '') {
            $this->errors[] = sprintf(
                Translation::get('validator_form_field_is_required'),
                $this->alias
            );
        }

        return $this;
    }

    public function isBetweenRange(
        int $min,
        int $max,
        string $errorMessage = ''
    ): FormValidator {
        $number = (int)$this->input;
        if ($number < $min || $number > $max) {
            $error = $errorMessage;
            if ($errorMessage === '') {
                $error = sprintf(
                    Translation::get('validator_form_field_has_invalid_range'),
                    $this->alias,
                    $min,
                    $max
                );
            }

            $this->errors[] = $error;
        }

        return $this;
    }

    public function isEmail(): FormValidator
    {
        if (!(bool)filter_var($this->input, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = Translation::get('validator_form_email_is_invalid');
        }

        return $this;
    }

    public function isUnique(
        ?object $databaseRecord,
        string $errorMessage = ''
    ): FormValidator {
        if ($databaseRecord !== null) {
            $error = $errorMessage;
            if ($errorMessage === '') {
                $error = sprintf(
                    Translation::get('validator_form_field_is_unique'),
                    $this->alias
                );
            }

            $this->errors[] = $error;
        }

        return $this;
    }

    public function passwordIsEqual(string $password): FormValidator
    {
        if ($this->input !== $password) {
            $this->errors[] = Translation::get('validator_form_passwords_are_not_equal');
        }

        return $this;
    }

    public function passwordIsNotCurrentPassword(
        string $currentHashedPassword
    ): FormValidator {
        if (password_verify($this->input, $currentHashedPassword)) {
            $this->errors[] = Translation::get(
                'validator_form_new_password_cannot_be_the_same_as_the_current_password'
            );
        }

        return $this;
    }

    public function passwordIsVerified(string $hashedPassword): FormValidator
    {
        if (!password_verify($this->input, $hashedPassword)) {
            $this->errors[] = Translation::get('validator_form_passwords_is_not_verified');
        }

        return $this;
    }

    /**
     * @return string[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getErrorsAsString(): string
    {
        $error = Translation::get('validator_form_base_error_message') . '<br><br>';

        foreach ($this->errors as $singleError) {
            $error .= '- ' . $singleError . '<br>';
        }

        return $error;
    }

    public function flashErrorsIntoSession(): void
    {
        if (sizeof($this->errors) === 0) {
            return;
        }

        $session = new Session();
        $session->flash(
            State::FORM_VALIDATION_FAILED,
            $this->getErrorsAsString()
        );
    }

    public function validate(): bool
    {
        return sizeof($this->errors) === 0;
    }

    public function handleFormValidation(): bool
    {
        $this->flashErrorsIntoSession();

        return $this->validate();
    }
}
