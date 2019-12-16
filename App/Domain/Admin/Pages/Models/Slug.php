<?php
declare(strict_types=1);


namespace App\Domain\Admin\Pages\Models;

use App\Src\Model\Model;
use App\Src\Model\Scopes\SoftDelete\SoftDelete;

final class Slug extends Model
{
    use SoftDelete;

    protected string $table = 'slug';
    protected string $primaryKey = 'slug_ID';
    protected string $softDeletedKey = 'slug_is_deleted';

    public function __construct()
    {
        $this->initializeSoftDelete();
    }

    public function parse(string $slug): string
    {
        return strtolower(replaceString(
            ' ',
            '-',
            $slug
        ));
    }
}
