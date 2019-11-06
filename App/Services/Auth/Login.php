<?php
declare(strict_types=1);


namespace App\Services\Auth;

use App\Models\User;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Session\Session;
use App\Src\Translation\Translation;

final class Login
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
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

        if (password_verify($this->user->getPassword(),
            $this->user->getAccount()->account_password ?? '')
        ) {
            if ($session->exists('userID')) {
                $session->unset('userID');
            }

            $session->save(
                'userID', $this->user->getAccount()->account_ID ?? ''
            );

            // todo rehash password
            // todo reset failed log in tries
            $session->flash(
                'success', Translation::get('login_successful_message')
            );
            return true;
        }

        // todo update failed log in tries and if necessary block account

        $session->flash(
            'error', Translation::get('login_failed_message')
        );
        return false;
    }
}
