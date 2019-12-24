<?php
declare(strict_types=1);


namespace App\Domain\Pages\Models;

use App\Src\Core\Router;
use App\Src\Core\URI;
use App\Src\Database\DB;
use App\Src\Model\Model;
use App\Src\Model\Scopes\SoftDelete\SoftDelete;
use stdClass;

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
    protected string $isPublishedKey = 'page_is_published';
    protected string $softDeletedKey = 'page_is_deleted';

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
            )->where(
                $this->isPublishedKey,
                '=',
                '1'
            )
        );

        $this->initializeSoftDelete();
    }

    public function getSlug(): string
    {
        return Router::getWildcard() === '' ? URI::getUrl() : Router::getWildcard();
    }

    public function getBySlug(string $slug): ?stdClass
    {
        return $this->firstByAttributes([
            $this->slugKey => $slug
        ]);
    }
}
