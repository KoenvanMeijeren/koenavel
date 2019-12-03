<?php
declare(strict_types=1);


namespace App\Models\Admin;

use App\Src\Model\Model;

final class Page extends Model
{
    protected string $table = 'page';
    protected string $primaryKey = 'page_ID';
}
