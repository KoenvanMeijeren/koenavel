<?php
declare(strict_types=1);


namespace App\Http\Domain\Admin\Accounts\Account\ViewModels;

use App\Http\Domain\Repositories\AccountRepository;
use App\Models\User;
use App\Services\Helpers\Converter;
use App\Services\Helpers\DataTable;
use App\Services\Helpers\Resource;
use App\Src\Translation\Translation;

final class IndexViewModel
{
    /**
     * @var object[]
     */
    private array $accounts;

    private DataTable $dataTable;
    private User $user;

    /**
     * @param object[] $accounts
     */
    public function __construct(array $accounts)
    {
        $this->accounts = $accounts;
        $this->dataTable = new DataTable();
        $this->user = new User();
    }

    public function table(): string
    {
        $this->dataTable->addEditHead('Naam', 'Email', 'Rechten');

        foreach ($this->accounts as $singleAccount) {
            $account = new AccountRepository($singleAccount);
            $rights = new Converter($account->getRights());
            $blocked = new Converter($account->isBlocked());

            if ($account->isBlocked()) {
                $this->dataTable->addClasses('user-blocked');
            }

            $this->dataTable->addRow(
                ucfirst($account->getName()) . $blocked->toReadableBlockState(),
                lcfirst($account->getEmail()),
                $rights->toReadableRights(),
                Resource::addTableEditColumn(
                    '/admin/account/edit/' . $account->getId(),
                    '/admin/account/delete/' . $account->getId(),
                    Translation::get('admin_delete_account_warning_message'),
                    $this->user->getID() === $account->getId()
                )
            );
        }

        return $this->dataTable->get();
    }
}
