<?php
declare(strict_types=1);


namespace App\Src\Database;


use PDOException;
use stdClass;

trait DataProcessingStatements
{
    /**
     * Execute the prepared query.
     *
     * @return DatabaseProcessor
     * @throws PDOException
     */
    public abstract function execute(): DatabaseProcessor;

    /**
     * Get every record from the table which matches with the given query.
     *
     * @return array
     */
    public function get(): array
    {
        return $this->execute()->all();
    }

    /**
     * Get the first record from the table which matches with the given query.
     *
     * @return stdClass
     */
    public function first()
    {
        return $this->execute()->first();
    }
}
