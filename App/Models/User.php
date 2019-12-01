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
use stdClass;

final class User extends BaseModel
{
    /**
     * The follow rights option ara available.
     *
     * - Accessible for everyone
     * - Admin
     * - Super Admin
     * - Developer
     *
     * @var int
     */
    public const GUEST = 0;
    public const ADMIN = 1;
    public const SUPER_ADMIN = 2;
    public const DEVELOPER = 3;

    protected string $email;
    protected string $password;
    protected string $token;

    private stdClass $account;

    public function __construct()
    {
        $request = new Request();

        $this->table = 'account';
        $this->setColumns('*');
        $this->idColumn = 'account_ID';

        $this->id = $this->getID();
        $this->account = $this->get();

        $this->email = $request->post('email');
        $this->password = $request->post('password');
        $this->token = $request->post('verificationToken');

        $this->authorizeUser();
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
    public function get(): stdClass
    {
        $this->setIDFilter();
        $this->setDefaultFilters();

        return $this->getBy();
    }

    /**
     * Get the account of the user.
     *
     * If the user is logged in the account will be returned.
     * Otherwise an empty std class.
     *
     * @return stdClass
     */
    public function getByEmail(): stdClass
    {
        $this->setEmailFilter();
        $this->setDefaultFilters();

        return $this->getBy();
    }

    /**
     * Get the id of the user.
     *
     * It does not matter if the user is logged in.
     * If the user is logged in, the id of the user will be returned.
     * Otherwise the guest id is returned.
     *
     * @return int the id of the user
     */
    public function getID(): int
    {
        $session = new Session();
        $idEncryption = new IDEncryption();

        $id = $idEncryption->decrypt($session->get('userID'));
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
            && $this->getRights() !== self::DEVELOPER
        ) {
            return $this->logout();
        }

        if (!$idEncryption->validateHash(
            $this->account->account_login_token ?? '',
            $session->get('userID')
        )) {
            return $this->logout();
        }

        if ((int) ($this->account->account_is_blocked ?? '') === 1) {
            return $this->logout();
        }
    }

    /**
     * Set default filters, which the user must pass if he will be
     * able to use his account.
     */
    private function setDefaultFilters(): void
    {
        $this->setFilter(
            'account_is_blocked',
            '=',
            '0'
        );

        $this->setFilter(
            'account_is_deleted',
            '=',
            '0'
        );
    }

    private function setIDFilter(): void
    {
        $this->setFilter(
            $this->idColumn,
            '=',
            (string) $this->id
        );
    }

    private function setEmailFilter(): void
    {
        $this->setFilter(
            'account_email',
            '=',
            $this->email
        );
    }
}
