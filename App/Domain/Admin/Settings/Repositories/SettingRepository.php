<?php
declare(strict_types=1);


namespace App\Domain\Admin\Settings\Repositories;

final class SettingRepository
{
    private ?object $setting;

    private int $id;
    private string $key;
    private string $value;
    private bool $isDeleted;

    public function __construct(?object $setting)
    {
        $this->setting = $setting;

        $this->id = (int) ($setting->setting_ID ?? '0');
        $this->key = $setting->setting_key ?? '';
        $this->value = $setting->setting_value ?? '';
        $this->isDeleted = (bool) ($setting->setting_is_deleted ?? '0');
    }

    public function get(): ?object
    {
        return $this->setting;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }
}
