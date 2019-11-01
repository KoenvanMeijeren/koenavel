<?php
declare(strict_types=1);


namespace App\Models;

use App\Src\Core\Router;
use App\Src\Model\BaseModel;

class User extends BaseModel
{
    /**
     * Construct the model.
     */
    public function __construct()
    {
        $this->table = 'Account';
        $this->setColumns('*');

        $this->idColumn = 'account_ID';
        $this->id = Router::getWildcard();

        $this->setFilters('account_education', '=', 'ICT');
        $this->setFilters('account_rights', '=', '1');
    }
}
