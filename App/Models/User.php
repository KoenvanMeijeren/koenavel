<?php
declare(strict_types=1);


namespace App\Models;

use App\Src\Core\Router;
use App\Src\Model\BaseModel;

final class User extends BaseModel
{
    /**
     * Accessible for everyone rights.
     *
     * @var int
     */
    const PUBLIC = 0;

    /**
     * Admin rights
     *
     * @var int
     */
    const ADMIN = 1;

    /**
     * Super admin rights.
     *
     * @var int
     */
    const SUPER_ADMIN = 2;

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
