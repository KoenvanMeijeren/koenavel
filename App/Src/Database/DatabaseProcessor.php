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
     * @return string[]|object[]|null
     */
    public function fetchAll(int $fetchMethod)
    {
        $data = $this->statement->fetchAll($fetchMethod);
        if ($data === false) $data = null;

        return $data;
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
        $data = $this->statement->fetch($fetchMethod);
        if ($data === false) $data = null;

        return $data;
    }

    /**
     * Fetch all the records from the database to an object.
     *
     * @return object[]|null
     */
    public function all()
    {
        return $this->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Fetch all the records from the database to an array.
     *
     * @return string[]
     */
    public function toArray()
    {
        $data = $this->fetchAll(PDO::FETCH_NAMED);
        if (is_null($data)) $data = [];

        return $data;
    }

    /**
     * Fetch the first record found in the database into an object.
     *
     * @return stdClass|null
     */
    public function first()
    {
        return $this->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Fetch the first record found in the database into an array.
     *
     * @return string[]
     */
    public function firstToArray()
    {
        $data = $this->fetch(PDO::FETCH_NAMED);
        if (is_null($data)) $data = [];

        return $data;
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
