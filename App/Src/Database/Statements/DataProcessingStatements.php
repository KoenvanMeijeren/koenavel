<?php
declare(strict_types=1);


namespace App\Src\Database\Statements;

use App\Src\Database\DatabaseProcessor;
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
    abstract public function execute(): DatabaseProcessor;

    /**
     * Fetch all records from the database with the given fetch method.
     *
     * @param int $fetchMethod The used method to fetch the database records.
     *
     * @return string[]|object[]|null
     */
    public function fetchAll(int $fetchMethod): ?array
    {
        return $this->execute()->fetchAll($fetchMethod);
    }

    /**
     * Fetch one record from the database with the given fetch method.
     *
     * @param int $fetchMethod The used method to fetch the database record.
     *
     * @return string[]|object|null
     */
    public function fetch(int $fetchMethod)
    {
        return $this->execute()->fetch($fetchMethod);
    }

    /**
     * Get every record from the table which matches with the given query.
     *
     * @return object[]|null
     */
    public function get(): ?array
    {
        return $this->execute()->all();
    }

    /**
     * Get every record from the table which matches with the given query.
     *
     * @return string[]
     */
    public function getToArray(): array
    {
        return $this->execute()->allToArray();
    }

    /**
     * Get the first record from the table which matches with the given query.
     *
     * @return stdClass|null
     */
    public function first(): ?stdClass
    {
        return $this->execute()->first();
    }

    /**
     * Get the first record from the table which matches with the given query.
     *
     * @return string[]
     */
    public function firstToArray(): array
    {
        return $this->execute()->firstToArray();
    }
}
