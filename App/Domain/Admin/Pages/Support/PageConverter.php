<?php
declare(strict_types=1);


namespace App\Domain\Admin\Pages\Support;


use App\Domain\Admin\Pages\Models\Page;
use App\Src\Translation\Translation;

class PageConverter
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

    public function toReadablePublicationState(): string
    {
        if ((bool) $this->var) {
            return Translation::get('admin_page_is_published');
        }

        return Translation::get('admin_page_is_not_published');
    }
}
