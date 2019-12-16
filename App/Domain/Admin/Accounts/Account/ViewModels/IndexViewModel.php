<?php
declare(strict_types=1);


namespace App\Domain\Admin\Accounts\Account\ViewModels;

use App\Domain\Admin\Accounts\Account\Support\AccountConverter;
use App\Domain\Admin\Accounts\Repositories\AccountRepository;
use App\Domain\Admin\Accounts\User\Models\User;
use App\Domain\Support\Converter;
use App\Src\Translation\Translation;
use App\Support\DataTable;
use App\Support\Resource;

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
            $rights = new AccountConverter($account->getRights());
            $blocked = new AccountConverter($account->isBlocked());

            if ($account->isBlocked()) {
                $this->dataTable->addClasses('row-warning');
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
