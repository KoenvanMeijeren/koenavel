<?php
declare(strict_types=1);


namespace App\Services\Helpers;

use App\Models\User;
use App\Src\Translation\Translation;

final class Converter
{
    private string $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function toReadableRights(): string
    {
        $rights = (int) $this->text;
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
        if ((int) $this->text === 0) {
            return '';
        }

        return ' - ' . Translation::get('account_is_blocked');
    }
}
