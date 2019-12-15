<?php
declare(strict_types=1);


namespace App\Domain\Repositories;

final class AccountRepository
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private int $rights;
    private string $logInToken;
    private int $failedLogInAttempts;
    private bool $isBlocked;
    private bool $isDeleted;

    public function __construct(?object $account)
    {
        $this->id = (int) ($account->account_ID ?? '0');
        $this->name = $account->account_name ?? '';
        $this->email = $account->account_email ?? '';
        $this->password = $account->account_password ?? '';
        $this->rights = (int) ($account->account_rights ?? '0');
        $this->logInToken = ($account->account_login_token ?? '0');
        $this->failedLogInAttempts = (int) ($account->account_failed_login ?? '0');
        $this->isBlocked = (bool) ($account->account_is_blocked ?? '');
        $this->isDeleted = (bool) ($account->account_is_deleted ?? '');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRights(): int
    {
        return $this->rights;
    }

    public function getLogInToken(): string
    {
        return $this->logInToken;
    }

    public function getFailedLogInAttempts(): int
    {
        return $this->failedLogInAttempts;
    }

    public function isBlocked(): bool
    {
        return $this->isBlocked;
    }

    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }
}
