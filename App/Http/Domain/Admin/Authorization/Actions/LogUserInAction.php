<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Authorization\Actions;

use App\Models\Admin\Account;
use App\Models\User;
use App\Services\Auth\IDEncryption;
use App\Src\Action\FormAction;
use App\Src\Core\Request;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use stdClass;

final class LogUserInAction extends FormAction
{
    /**
     * @var int
     */
    public const MAXIMUM_LOGIN_ATTEMPTS = 3;

    private User $user;
    private Session $session;
    private ?stdClass $account;

    private string $email;
    private string $password;

    private array $attributes;

    public function __construct(User $user)
    {
        $request = new Request();
        $this->user = $user;
        $this->session = new Session();

        $this->email = $request->post('email');
        $this->password = $request->post('password');

        $this->account = $this->user->getByEmail($this->email);
    }

    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        if (password_verify(
            $this->password,
            $this->account->account_password ?? ''
        )) {
            $this->session->unset('userID');

            $idEncryption = new IDEncryption();
            $token = $idEncryption->generateToken();

            $this->session->save('userID', $idEncryption->encrypt(
                $this->account->account_ID ?? '0',
                $token
            ));

            // always executed
            $this->storeToken($token);
            $this->rehashPassword();
            // only executed when the user is an admin
            $this->resetFailedLogInAttempts();

            $this->store();

            $this->session->flash(
                State::SUCCESSFUL,
                Translation::get('login_successful_message')
            );

            return true;
        }

        // only executed when the user is an admin
        $this->addFailedLogInAttempt();
        $this->blockAccount();

        $this->store();

        $this->session->flash(
            State::FAILED,
            Translation::get('login_failed_message')
        );

        return false;
    }

    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
        if ($this->accountIsBlocked()) {
            return false;
        }

        return parent::authorize();
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        if (empty($this->email)
            || empty($this->password)) {
            $this->session->flash(
                State::FAILED,
                Translation::get('form_message_for_required_fields')
            );

            return false;
        }

        if (! (bool) filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $this->session->flash(
                State::FAILED,
                sprintf(
                    Translation::get('form_invalid_email_message'),
                    $this->email
                )
            );

            return false;
        }

        return true;
    }

    /**
     * Store the login token for the user
     *
     * @param string $token The login token from the user.
     *
     * @return void
     */
    private function storeToken(string $token): void
    {
        $this->attributes['account_login_token'] = $token;
    }

    /**
     * Rehash the password if necessary.
     */
    private function rehashPassword(): void
    {
        if (password_needs_rehash(
            $this->account->account_password ?? '',
            Account::PASSWORD_ENCRYPTION
        )
        ) {
            $this->attributes['account_password'] = (string) password_hash(
                $this->account->account_password ?? '',
                Account::PASSWORD_ENCRYPTION
            );
        }
    }

    /**
     * Reset the number of failed log in attempts.
     */
    private function resetFailedLogInAttempts(): void
    {
        if ((int) ($this->account->account_rights ?? '') > User::ADMIN) {
            return;
        }

        $this->attributes['account_failed_login'] = '0';
    }

    /**
     * Add a failed log in attempt.
     */
    private function addFailedLogInAttempt(): void
    {
        if ((int) ($this->account->account_rights ?? '') > User::ADMIN) {
            return;
        }

        $current = $this->account->account_failed_login ?? '0';

        $this->attributes['account_failed_login'] = (string) ((int) $current + 1);
    }

    /**
     * If the number of failed log in attempts is higher than
     * the maximum number of failed log in attempts, block the account
     */
    private function blockAccount(): void
    {
        if ((int) ($this->account->account_rights ?? '') > User::ADMIN) {
            return;
        }

        $failedLogInAttempts = $this->account->account_failed_login ?? '0';
        if ((int) $failedLogInAttempts >= self::MAXIMUM_LOGIN_ATTEMPTS) {
            $this->attributes['account_is_blocked'] = '1';
        }
    }

    /**
     * Save the date into the database.
     */
    private function store(): void
    {
        if (empty($this->attributes)) {
            return;
        }

        $this->user->update(
            (int) ($this->account->account_ID ?? '0'),
            $this->attributes
        );
    }

    /**
     * Determine if the account has been blocked.
     *
     * @return bool
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    private function accountIsBlocked(): bool
    {
        if ((int) ($this->account->account_is_blocked ?? '') === 1) {
            $this->session->flash(
                State::FAILED,
                Translation::get('login_failed_blocked_account_message')
            );

            return true;
        }

        return false;
    }
}
