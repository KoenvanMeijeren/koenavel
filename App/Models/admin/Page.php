<?php
declare(strict_types=1);


namespace App\Models\admin;

use App\Src\Model\BaseModel;

final class Page extends BaseModel
{
    /**
     * Construct the page.
     */
    public function __construct()
    {
        $this->table = 'Page';
        $this->setColumns('*');

        $this->idColumn = 'page_ID';
    }
}
