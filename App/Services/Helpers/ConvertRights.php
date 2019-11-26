<?php
declare(strict_types=1);


namespace App\Services\Helpers;

use App\Models\User;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;
use App\Src\Translation\Translation;

final class ConvertRights
{
    /**
     * @var int
     */
    private $rights;

    public function __construct(string $rights)
    {
        $this->rights = (int) $rights;
    }

    /**
     * Convert the given rights into readable rights.
     *
     * @return string
     * @throws InvalidKeyException
     * @throws NoTranslationsForGivenLanguageID
     */
    public function convert(): string
    {
        if ($this->rights === User::ADMIN) {
            return Translation::get('account_rights_admin');
        } elseif ($this->rights === User::SUPER_ADMIN) {
            return Translation::get('account_rights_super_admin');
        } elseif ($this->rights === User::DEVELOPER) {
            return Translation::get('account_rights_developer');
        }

        return Translation::get('account_rights_guest');
    }
}
