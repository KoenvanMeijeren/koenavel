<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Dashboard\Controllers;

use App\Src\Translation\Translation;
use App\Src\View\View;

final class DashboardController
{
    public function index(): View
    {
        $title =  Translation::get('admin_dashboard_title');

        return new View(
            'admin/dashboard/index',
            compact('title')
        );
    }
}
