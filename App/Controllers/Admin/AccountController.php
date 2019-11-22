<?php
declare(strict_types=1);


namespace App\Controllers\Admin;

use App\Models\User;
use App\Services\Helpers\ConvertRights;
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

        $dataTable = new DataTable();
        $dataTable->addHead('Naam', 'Email', 'Rechten');

        $accounts = $this->user->getAll();
        array_walk($accounts, function ($account) use ($dataTable) {
            $rights = new ConvertRights($account->account_rights ?? '0');

            $dataTable->addRow(
                ucfirst($account->account_name ?? ''),
                lcfirst($account->account_email ?? ''),
                $rights->convert()
            );
        });

        $accounts = $dataTable->get();

        return new View(
            'admin/account/index',
            compact('title', 'accounts')
        );
    }
}
