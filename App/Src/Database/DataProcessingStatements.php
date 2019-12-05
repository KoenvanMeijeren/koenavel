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
    abstract public function execute(): DatabaseProcessor;

    /**
     * Fetch all records from the database with the given fetch method.
     *
     * @param int $fetchMethod The used method to fetch the database records.
     *
     * @return string[]|object[]|null
     */
    public function fetchAll(int $fetchMethod)
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
    public function get()
    {
        return $this->execute()->all();
    }

    /**
     * Get every record from the table which matches with the given query.
     *
     * @return array
     */
    public function getToArray(): array
    {
        return $this->execute()->toArray();
    }

    /**
     * Get the first record from the table which matches with the given query.
     *
     * @return stdClass|null
     */
    public function first()
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
