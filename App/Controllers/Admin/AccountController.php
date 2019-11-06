<?php
declare(strict_types=1);


namespace App\Controllers\Admin;

use App\Src\Translation\Translation;
use App\Src\View\View;

final class AccountController
{
    public function index(): View
    {
        $title = Translation::get('admin_account_title');

        return new View('admin/account/account', compact('title'));
    }
}
