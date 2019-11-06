<?php
declare(strict_types=1);


namespace App\Controllers\Admin;

use App\Services\Helpers\DataTable;
use App\Src\Translation\Translation;
use App\Src\View\View;

final class AccountController
{
    public function index(): View
    {
        $title = Translation::get('admin_account_title');

        $dataTable = new DataTable('account');
        $dataTable->addHead('ID', 'Name', 'Email');
        $dataTable->addRow('1', 'Koen', 'test@test.nl');
        $dataTable->addRow('1', 'Koen', 'test@test.nl');
        $dataTable->addRow('1', 'Koen', 'test@test.nl');
        $dataTable->addRow('1', 'Koen', 'test@test.nl');
        $dataTable->addRow('1', 'Koen', 'test@test.nl');
        $dataTable->addRow('1', 'Koen', 'test@test.nl');
        $dataTable->addRow('1', 'Koen', 'test@test.nl');
        $dataTable->addRow('1', 'Koen', 'test@test.nl');
        $dataTable->addRow('1', 'Koen', 'test@test.nl');
        $dataTable->addRow('1', 'Koen', 'test@test.nl');
        $dataTable->addRow('1', 'Koen', 'test@test.nl');
        $dataTable->addRow('1', 'Koen', 'test@test.nl');
        $table = $dataTable->getTable();

        return new View('admin/account/account',
            compact('title', 'table')
        );
    }
}
