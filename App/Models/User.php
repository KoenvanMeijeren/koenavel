<?php
declare(strict_types=1);


namespace App\Models;

use App\Services\Auth\IDEncryption;
use App\Src\Core\Request;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Exceptions\Session\InvalidSessionException;
use App\Src\Model\BaseModel;
use App\Src\Response\Redirect;
use App\Src\Session\Builder;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use Exception;
use stdClass;

final class User extends BaseModel
{
    /**
     * Accessible for everyone rights.
     *
     * @var int
     */
    const GUEST = 0;

    /**
     * Admin rights
     *
     * @var int
     */
    const ADMIN = 1;

    /**
     * Super admin rights.
     *
     * @var int
     */
    const SUPER_ADMIN = 2;

    /**
     * The account of the user.
     *
     * @var object
     */
    protected $account;

    /**
     * The email of the user.
     *
     * @var string
     */
    protected $email;

    /**
     * The password of the user.
     *
     * @var string
     */
    protected $password;

    /**
     * The verification token of the user
     *
     * @var string
     */
    protected $token;

    public function __construct()
    {
        $request = new Request();

        $this->table = 'Account';
        $this->setColumns('*');

        $this->idColumn = 'account_ID';
        $this->id = $this->getID();

        $this->email = $request->post('email');
        $this->password = $request->post('password');
        $this->token = $request->post('verificationToken');

        $this->account = $this->getAccount();

        $this->authorizeUser();
    }

    /**
     * Get the given email of the user.
     * (only available with a POST request)
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Get the given password of the user.
     * (only available with a POST request)
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Get the account of the user.
     *
     * If the user is logged in the account will be returned.
     * Otherwise an empty std class.
     *
     * @return stdClass
     */
    public function getAccount(): stdClass
    {
        $account = $this->get();
        if (empty((array)$account)) {
            $this->setFilter(
                'account_email',
                '=',
                $this->email
            );

            $account = $this->getBy();
        }

        return $account;
    }

    /**
     * Get the id of the user.
     *
     * It does not matter if the user is logged in.
     * If the user is logged in, the id of the user will be returned.
     * Otherwise the guest id is returned.
     *
     * @return int the id of the user
     * @throws Exception
     */
    public function getID(): int
    {
        $session = new Session();
        $idEncryption = new IDEncryption();

        $id = $idEncryption->decrypt(
            $session->get('userID')
        );
        if ($id !== self::GUEST) {
            return $id;
        }

        return self::GUEST;
    }

    /**
     * Get the name of the user.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->account->account_name ?? '';
    }

    /**
     * Get the rights of the user.
     *
     * It does not matter if the user is logged in.
     * If the user is logged in, the rights of the user will be returned.
     * Otherwise the guest rights are returned.
     *
     * @return int the rights of the user, guest, admin or super admin
     */
    public function getRights(): int
    {
        return intval($this->account->account_rights ?? self::GUEST);
    }

    /**
     * Determine if the user is logged in.
     *
     * @return bool
     */
    public function isLoggedIn(): bool
    {
        if ($this->getRights() > self::GUEST) {
            return true;
        }

        return false;
    }

    /**
     * Log the user out and redirect the user.
     *
     * @param string $redirectTo the path to redirect the user to
     *                           after the user is logged out.
     *
     * @return Redirect
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     * @throws InvalidSessionException
     */
    public function logout(string $redirectTo = '/admin'): Redirect
    {
        $builder = new Builder();
        $builder->destroy();

        $builder->startSession();
        $builder->setSessionSecurity();

        $session = new Session();
        $session->flash(State::SUCCESSFUL, Translation::get('admin_logout_message'));

        return new Redirect($redirectTo);
    }

    /**
     * Authorize the user.
     *
     * - Check if the rights are valid and if not log the user out.
     * - Check if the user is really the user which he says that he is
     *   and if not log the user out.
     *
     * @return void|Redirect
     * @throws InvalidKeyException
     * @throws InvalidSessionException
     * @throws NoTranslationsForGivenLanguageID
     */
    private function authorizeUser()
    {
        $session = new Session();
        $idEncryption = new IDEncryption();

        if ($this->getRights() !== self::GUEST
            && $this->getRights() !== self::ADMIN
            && $this->getRights() !== self::SUPER_ADMIN
        ) {
            return $this->logout();
        }

        if (!$idEncryption->validate_hash(
            $this->getAccount()->account_login_token ?? '',
            $session->get('userID')
        )) {
            return $this->logout();
        }
    }

    /**
     * Store the login token for the user
     *
     * @param string $id    The id of the user.
     * @param string $token The login token from the user.
     *
     * @return void
     */
    public function storeToken(string $id, string $token)
    {
        $this->setFields([
            'account_login_token' => $token
        ]);

        $this->setFilter('account_ID', '=', $id);
        $this->setFilter('account_is_deleted', '=', '0');

        $this->save();
    }
}
