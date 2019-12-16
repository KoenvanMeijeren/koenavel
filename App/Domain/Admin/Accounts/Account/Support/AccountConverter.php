<?php
declare(strict_types=1);


namespace App\Domain\Admin\Accounts\Account\Support;

use App\Domain\Admin\Accounts\User\Models\User;
use App\Src\Translation\Translation;

final class AccountConverter
{
    /**
     * @var mixed
     */
    private $var;

    /**
     * @param mixed $var
     */
    public function __construct($var)
    {
        $this->var = $var;
    }

    public function toReadableRights(): string
    {
        $rights = (int) $this->var;
        if ($rights === User::ADMIN) {
            return Translation::get('account_rights_admin');
        }

        if ($rights === User::SUPER_ADMIN) {
            return Translation::get('account_rights_super_admin');
        }

        if ($rights === User::DEVELOPER) {
            return Translation::get('account_rights_developer');
        }

        return Translation::get('account_rights_guest');
    }

    public function toReadableBlockState(): string
    {
        if (!(bool) $this->var) {
            return '';
        }

        return ' - ' . Translation::get('account_is_blocked');
    }
}
