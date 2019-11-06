<?php
declare(strict_types=1);


namespace App\Controllers\Admin;

use App\Models\User;
use App\Services\Helpers\DataTable;
use App\Src\Database\DB;
use App\Src\Translation\Translation;
use App\Src\View\View;

final class DashboardController
{
    public function index(): View
    {
        $title =  Translation::get('admin_dashboard_title');
        $accounts = DB::table('account')
            ->select('*')
            ->execute()
            ->all();

        $dataTable = new DataTable('dashboard');
        $dataTable->addHead(
            'ID', 'Naam', 'Email', 'Rechten'
        );
        foreach ($accounts as $account) {
            $rights = 'Beheerder';
            if (intval($account->account_rights ?? 0) === User::SUPER_ADMIN) {
                $rights = 'Super-beheerder';
            }

            $dataTable->addRow(
                $account->account_ID ?? '',
                ucfirst($account->account_name ?? ''),
                lcfirst($account->account_email ?? ''),
                $rights
            );
        }
        $dataTable->addFooter(
            'ID', 'Naam', 'Email', 'Rechten'
        );
        $table = $dataTable->getTable();

        return new View('admin/dashboard/index',
            compact('title', 'table')
        );
    }
}
