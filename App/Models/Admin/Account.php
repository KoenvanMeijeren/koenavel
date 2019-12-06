<?php
declare(strict_types=1);


namespace App\Models\Admin;

use App\Src\Core\Router;
use App\Src\Model\Model;
use stdClass;

final class Account extends Model
{
    protected string $table = 'account';
    protected string $primaryKey = 'account_ID';
    protected string $softDeletedKey = 'account_is_deleted';

    /**
     * The encryption of the account password.
     *
     * @var int
     */
    public const PASSWORD_ENCRYPTION = PASSWORD_ARGON2ID;

    /**
     * Get the id of the account.
     *
     * @return int
     */
    public function getID(): int
    {
        return (int) Router::getWildcard();
    }

    /**
     * Get an account by the given email.
     *
     * @param string $email
     *
     * @return stdClass|null
     */
    public function getByEmail(string $email): ?stdClass
    {
        return $this->firstByAttributes([
            'account_email' => $email
        ]);
    }

    public function getPassword(stdClass $account): string
    {
        return $this->account->account_password ?? '';
    }

    /**
     * Determine if the given account has been blocked.
     *
     * @param stdClass $account
     *
     * @return bool
     */
    public function isBlocked(stdClass $account): bool
    {
        return (int)($account->account_is_blocked ?? '') === 1;
    }
}
