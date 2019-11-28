<?php
declare(strict_types=1);


namespace App\Services\Auth;

use App\Models\User;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Model\BaseModel;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use stdClass;

final class Login extends BaseModel
{
    /**
     * @var int
     */
    const MAXIMUM_LOGIN_ATTEMPTS = 3;

    private User $user;
    private stdClass $account;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->account = $this->user->getByEmail();

        $this->table = 'account';
    }

    /**
     * Determine if the user is going to be logged in.
     * If the given credentials matches with the data in
     * the database, the ID of the user will be saved in
     * the session. Otherwise the user will be redirected
     * to the login page with an error.
     *
     * @note If the user is logged in, during every new request
     *       the user will be authorized.
     *
     * @return bool
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function execute(): bool
    {
        $session = new Session();
        if ($this->accountIsBlocked()) {
            $session->flash(
                State::FAILED,
                Translation::get('login_failed_blocked_account_message')
            );

            return false;
        }

        if (password_verify(
            $this->user->getPassword(),
            $this->account->account_password ?? ''
        )) {
            $session->unset('userID');

            $idEncryption = new IDEncryption();
            $token = $idEncryption->generateToken();

            $session->save('userID', $idEncryption->encrypt(
                $this->account->account_ID ?? '0',
                $token
            ));

            // always executed
            $this->storeToken($token);

            // only be executed when the user is not a super admin
            $this->rehashPassword();
            $this->resetFailedLogInAttempts();
            $this->store();

            $session->flash(
                State::SUCCESSFUL,
                Translation::get('login_successful_message')
            );
            return true;
        }

        // only be executed when the user is not a super admin
        $this->addFailedLogInAttempt();
        $this->blockAccount();
        $this->store();

        $session->flash(
            State::FAILED,
            Translation::get('login_failed_message')
        );
        return false;
    }

    /**
     * Store the login token for the user
     *
     * @param string $token The login token from the user.
     *
     * @return void
     */
    public function storeToken(string $token): void
    {
        $this->setFields([
            'account_login_token' => $token
        ]);

        $this->setFilter(
            'account_ID',
            '=',
            $this->account->account_ID ?? '0'
        );
        $this->setFilter(
            'account_is_deleted',
            '=',
            '0'
        );

        $this->save();
    }

    /**
     * Rehash the password if necessary.
     */
    private function rehashPassword(): void
    {
        if (password_needs_rehash(
            $this->account->account_password ?? '',
            PASSWORD_BCRYPT
        )
        ) {
            $this->setFields([
                'account_password' => (string) password_hash(
                    $this->account->account_password ?? '',
                    PASSWORD_BCRYPT
                )
            ]);
        }
    }

    /**
     * Reset the number of failed log in attempts.
     */
    private function resetFailedLogInAttempts(): void
    {
        $this->setFields([
            'account_failed_login' => '0'
        ]);
    }

    /**
     * Add a failed log in attempt.
     */
    private function addFailedLogInAttempt(): void
    {
        $current = $this->account->account_failed_login ?? '0';

        $this->setFields([
            'account_failed_login' => (string) ((int) $current + 1)
        ]);
    }

    /**
     * If the number of failed log in attempts is higher than
     * the maximum number of failed log in attempts, block the account
     */
    private function blockAccount(): void
    {
        $failedLogInAttempts = $this->account->account_failed_login ?? '0';
        if ((int) $failedLogInAttempts >= self::MAXIMUM_LOGIN_ATTEMPTS) {
            $this->setFields([
                'account_is_blocked' => '1'
            ]);
        }
    }

    /**
     * Save the date into the database.
     */
    private function store(): void
    {
        $this->setFilter(
            'account_ID',
            '=',
            $this->account->account_ID ?? '0'
        );
        $this->setFilter(
            'account_is_deleted',
            '=',
            '0'
        );
        $this->setFilter(
            'account_rights',
            '<',
            (string) User::SUPER_ADMIN
        );

        $this->save();
    }

    /**
     * Determine if the account has been blocked.
     *
     * @return bool
     */
    private function accountIsBlocked(): bool
    {
        if (!array_key_exists(
            'account_is_blocked',
            (array) $this->account
        )) {
            return false;
        }

        if ((int) $this->account->account_is_blocked === 1) {
            return true;
        }

        return false;
    }
}
