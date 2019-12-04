<?php
declare(strict_types=1);


namespace App\Models;

use App\Actions\Account\User\Auth\LogUserOutAction;
use App\Services\Auth\IDEncryption;
use App\Src\Model\Model;
use App\Src\Session\Session;
use stdClass;

final class User extends Model
{
    protected string $table = 'account';
    protected string $primaryKey = 'account_ID';
    protected string $softDeletedKey = 'account_is_deleted';

    /**
     * The follow rights option are available.
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

    private stdClass $account;

    public function __construct()
    {
        $this->account = $this->find($this->getID());

        $this->authorizeUser();
    }

    /**
     * Get the account of the user.
     *
     * If the user is logged in the account will be returned.
     * Otherwise an empty std class.
     *
     * @param string $email
     *
     * @return stdClass
     */
    public function getByEmail(string $email)
    {
        return $this->firstByAttributes([
            'account_email' => $email
        ]);
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
     * Get the account of the user.
     *
     * @return false|stdClass
     */
    public function getAccount()
    {
        return $this->account;
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
     * Authorize the user.
     *
     * - Check if the rights are valid and if not log the user out.
     * - Check if the user is really the user which he says that he is
     *   and if not log the user out.
     *
     * @return void|bool
     */
    private function authorizeUser()
    {
        $logout = new LogUserOutAction($this);
        $session = new Session();
        $idEncryption = new IDEncryption();

        if ($this->getRights() !== self::GUEST
            && $this->getRights() !== self::ADMIN
            && $this->getRights() !== self::SUPER_ADMIN
            && $this->getRights() !== self::DEVELOPER
        ) {
            return $logout->execute();
        }

        if (!$idEncryption->validateHash(
            $this->account->account_login_token ?? '',
            $session->get('userID')
        )) {
            return $logout->execute();
        }

        if ((int) ($this->account->account_is_blocked ?? '0') === 1) {
            return $logout->execute();
        }
    }
}
