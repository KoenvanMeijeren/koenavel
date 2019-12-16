<?php
declare(strict_types=1);


namespace App\Domain\Admin\Pages\Support;


use App\Src\Converter\Converter;
use App\Src\Translation\Translation;

final class PageIsPublishedStateConverter extends Converter
{
    public function toReadable(): string
    {
        if ((bool) $this->var) {
            return Translation::get('admin_page_is_published');
        }

        return Translation::get('admin_page_is_not_published');
    }
}
