<?php
declare(strict_types=1);


namespace App\Http\Domain\Repositories;

final class PageRepository
{
    private int $id;
    private string $title;
    private string $content;
    private int $inMenu;
    private bool $isPublished;
    private bool $isDeleted;

    private int $slugID;
    private string $slug;
    private bool $slugIsDeleted;

    public function __construct(?object $page)
    {
        $this->id = (int) ($page->page_ID ?? '0');
        $this->title = $page->page_title ?? '';
        $this->content = $page->page_content ?? '';
        $this->inMenu = (int) ($page->page_in_menu ?? '0');
        $this->isPublished = (bool) ($page->page_is_published ?? '0');
        $this->isDeleted = (bool) ($page->page_is_deleted ?? '0');

        $this->slugID = (int) ($page->slug_ID ?? '0');
        $this->slug = $page->slug_name ?? '';
        $this->slugIsDeleted = (bool) ($page->slug_is_deleted ?? '0');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getInMenu(): int
    {
        return $this->inMenu;
    }

    public function isPublished(): bool
    {
        return $this->isPublished;
    }

    public function isDeleted(): bool
    {
        return $this->isDeleted;
    }

    public function getSlugID(): int
    {
        return $this->slugID;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function isSlugIsDeleted(): bool
    {
        return $this->slugIsDeleted;
    }
}
