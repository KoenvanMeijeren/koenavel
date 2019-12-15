<?php
declare(strict_types=1);


namespace App\Domain\Support;

use App\Domain\Admin\Accounts\User\Models\User;
use App\Domain\Admin\Pages\Models\Page;
use App\Src\Translation\Translation;

final class Converter
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

    public function toReadableMenuState(): string
    {
        $menuState = (int) $this->var;
        if ($menuState === Page::PAGE_NOT_IN_MENU) {
            return Translation::get('page_not_in_menu');
        }

        if ($menuState === Page::PAGE_PUBLIC_IN_MENU) {
            return Translation::get('page_public_in_menu');
        }

        if ($menuState === Page::PAGE_LOGGED_IN_IN_MENU) {
            return Translation::get('page_logged_in_in_menu');
        }

        if ($menuState === Page::PAGE_STATIC) {
            return Translation::get('page_static');
        }

        if ($menuState === Page::PAGE_IN_FOOTER) {
            return Translation::get('page_in_footer_menu');
        }

        if ($menuState === Page::PAGE_IN_MENU_AND_IN_FOOTER) {
            return Translation::get('page_in_footer_and_in_menu');
        }

        return Translation::get('page_in_menu_state_unknown');
    }
}
