<?php
declare(strict_types=1);


namespace App\Domain\Admin\Accounts\Account\Models;

use App\Src\Core\Router;
use App\Src\Model\Model;
use App\Src\Model\Scopes\SoftDelete\SoftDelete;
use stdClass;

final class Account extends Model
{
    use SoftDelete;

    protected string $table = 'account';
    protected string $primaryKey = 'account_ID';
    protected string $softDeletedKey = 'account_is_deleted';

    /**
     * The hash method of the account password.
     *
     * @var int
     */
    public const PASSWORD_HASH_METHOD = PASSWORD_ARGON2ID;

    public function __construct()
    {
        $this->initializeSoftDelete();
    }

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
}
