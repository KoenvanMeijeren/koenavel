<?php
declare(strict_types=1);


namespace App\Http\Domain\Repositories;

final class SlugRepository
{
    private int $id;
    private string $slug;
    private bool $isDeleted;

    public function __construct(?object $slug)
    {
        $this->id = (int) ($slug->slug_ID ?? '0');
        $this->slug = $slug->slug_name ?? '';
        $this->isDeleted = (bool) ($slug->slug_is_deleted ?? '0');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }
}
