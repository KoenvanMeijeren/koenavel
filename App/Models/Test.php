<?php
declare(strict_types=1);


namespace App\Models;

use App\Src\Model\Model;

class Test extends Model
{
    protected string $table = 'test';
    protected string $primaryKey = 'test_id';
}
