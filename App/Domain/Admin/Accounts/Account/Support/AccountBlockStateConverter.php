<?php
declare(strict_types=1);


namespace App\Domain\Admin\Accounts\Account\Support;

use App\Src\Converter\Converter;
use App\Src\Translation\Translation;

final class AccountBlockStateConverter extends Converter
{
    public function toReadable(): string
    {
        if (!(bool) $this->var) {
            return '';
        }

        return ' - ' . Translation::get('account_is_blocked');
    }
}
