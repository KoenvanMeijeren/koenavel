<?php
declare(strict_types=1);


namespace App\Src\Database;

use PDO;
use PDOException;
use stdClass;

final class DatabaseProcessor extends DatabaseConnection
{
    /**
     * Bind each value to the specified column in the query.
     *
     * @param string[] $values The values to bind to the query.
     *
     * @throws PDOException
     * @codeCoverageIgnore
     */
    protected function bindValues(array $values): void
    {
        foreach ($values as $column => $value) {
            $this->statement->bindValue(
                ":{$column}",
                $value,
                PDO::PARAM_STR
            );
        }
    }

    /**
     * Fetch all records from the database with the given fetch method.
     *
     * @param int $fetchMethod The used method to fetch the database records.
     *
     * @return string[]|object[]|false
     */
    public function fetchAll(int $fetchMethod)
    {
        return $this->statement->fetchAll($fetchMethod);
    }

    /**
     * Fetch one record from the database with the given fetch method.
     *
     * @param int $fetchMethod The used method to fetch the database record.
     *
     * @return string[]|object|false
     */
    public function fetch(int $fetchMethod)
    {
        return $this->statement->fetch($fetchMethod);
    }

    /**
     * Fetch all the records from the database to an object.
     *
     * @return object[]|false
     */
    public function all()
    {
        return $this->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Fetch all the records from the database to an array.
     *
     * @return string[]|false
     */
    public function toArray()
    {
        return $this->fetchAll(PDO::FETCH_NAMED);
    }

    /**
     * Fetch the first record found in the database into an object.
     *
     * @return stdClass|false
     */
    public function first()
    {
        return $this->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Fetch the first record found in the database into an array.
     *
     * @return string[]|false
     */
    public function firstToArray()
    {
        return $this->fetch(PDO::FETCH_NAMED);
    }

    /**
     * Get the last inserted ID.
     *
     * @return int
     */
    public function getLastInsertedId(): int
    {
        return $this->lastInsertedId;
    }
}
