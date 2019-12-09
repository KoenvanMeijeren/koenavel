<?php
declare(strict_types=1);


namespace App\Services\Helpers;

use App\Models\User;
use App\Src\Translation\Translation;

final class Converter
{
    /**
     * @var mixed
     */
    private $var;

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
