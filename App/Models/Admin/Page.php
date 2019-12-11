<?php
declare(strict_types=1);


namespace App\Models\Admin;

use App\Src\Model\Model;
use App\Src\Model\Scopes\SoftDelete\SoftDelete;

final class Page extends Model
{
    use SoftDelete;

    protected string $table = 'page';
    protected string $primaryKey = 'page_ID';
    protected string $softDeletedKey = 'page_is_deleted';
}
