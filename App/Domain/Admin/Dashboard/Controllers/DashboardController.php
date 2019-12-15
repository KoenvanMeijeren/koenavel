<?php
declare(strict_types=1);


namespace App\Domain\Admin\Dashboard\Controllers;

use App\Src\Translation\Translation;
use App\Src\View\DomainView;

final class DashboardController
{
    private string $baseViewPath = 'Admin/Dashboard/Views/';

    public function index(): DomainView
    {
        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('admin_dashboard_title')
            ]
        );
    }
}
