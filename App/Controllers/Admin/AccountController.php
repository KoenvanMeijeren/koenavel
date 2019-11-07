<?php
declare(strict_types=1);


namespace App\Controllers\Admin;

use App\Models\User;
use App\Services\Helpers\DataTable;
use App\Src\Translation\Translation;
use App\Src\View\View;

final class AccountController
{
    /**
     * @var User
     */
    private $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(): View
    {
        $title = Translation::get('admin_account_title');
        $accounts = $this->user->getAll();

        $dataTable = new DataTable('dashboard');
        $dataTable->addHead(
            'Naam',
            'Email',
            'Rechten'
        );
        foreach ($accounts as $account) {
            $rights = 'Beheerder';
            if (intval($account->account_rights ?? 0) === User::SUPER_ADMIN) {
                $rights = 'Super-beheerder';
            }

            $dataTable->addRow(
                ucfirst($account->account_name ?? ''),
                lcfirst($account->account_email ?? ''),
                $rights
            );
        }
        $dataTable->addFooter(
            'Naam',
            'Email',
            'Rechten'
        );
        $table = $dataTable->get();

        return new View(
            'partials/table',
            compact('title', 'table')
        );
    }
}
