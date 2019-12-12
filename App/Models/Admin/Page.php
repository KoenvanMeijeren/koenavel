<?php
declare(strict_types=1);


namespace App\Models\Admin;

use App\Src\Core\Router;
use App\Src\Database\DB;
use App\Src\Model\Model;
use App\Src\Model\Scopes\SoftDelete\SoftDelete;
use stdClass;

// todo make it possible to publish or un-publish a page.
final class Page extends Model
{
    use SoftDelete;

    protected string $table = 'page';
    protected string $foreignTable = 'slug';
    protected string $primaryKey = 'page_ID';
    protected string $foreignKey = 'page_slug_ID';
    protected string $primarySlugKey = 'slug_ID';
    protected string $slugKey = 'slug_name';
    protected string $slugSoftDeletedKey = 'slug_is_deleted';
    protected string $softDeletedKey = 'page_is_deleted';

    /**
     * Possible page visibility options.
     * - Page not in menu
     * - Page public in menu
     * - Page logged in in menu
     * - Page is static
     * - Page in footer
     * - Page in menu and in footer
     *
     * @var int
     */
    public const PAGE_NOT_IN_MENU = 0;
    public const PAGE_PUBLIC_IN_MENU = 1;
    public const PAGE_LOGGED_IN_IN_MENU = 2;
    public const PAGE_STATIC = 3;
    public const PAGE_IN_FOOTER = 4;
    public const PAGE_IN_MENU_AND_IN_FOOTER = 5;

    public function __construct()
    {
        $this->addScope(
            (new DB)->innerJoin(
                $this->foreignTable,
                $this->primarySlugKey,
                $this->foreignKey
            )->where(
                $this->slugSoftDeletedKey,
                '=',
                '0'
            )
        );

        $this->initializeSoftDelete();
    }

    public function getID(): int
    {
        return (int) Router::getWildcard();
    }

    public function getSlug(): string
    {
        $slug = Router::getWildcard();
        if ($slug === '') {
            $slug = URI::getUrl();
        }

        return $slug;
    }

    public function getBySlug(string $slug): ?stdClass
    {
        return $this->firstByAttributes([
            $this->slugKey => $slug
        ]);
    }
}
