<?php
declare(strict_types=1);


namespace App\Models\Admin;

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

    public function getAll(): array
    {
        return parent::getAll();
    }
}
