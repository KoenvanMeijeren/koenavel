<?php
declare(strict_types=1);


namespace App\Src\Database;

use PDO;
use stdClass;

final class DatabaseProcessor extends DatabaseConnection
{
    /**
     * @inheritDoc
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
    public function fetchAll(int $fetchMethod): ?array
    {
        $data = $this->statement->fetchAll($fetchMethod);
        if ($data === false) {
            $data = null;
        }

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
        if ($data === false) {
            $data = null;
        }

        return $data;
    }

    public function all(): ?array
    {
        return $this->fetchAll(PDO::FETCH_OBJ);
    }

    public function allToArray(): array
    {
        $data = $this->fetchAll(PDO::FETCH_NAMED);
        if ($data === null) {
            $data = [];
        }

        return $data;
    }

    public function first(): ?stdClass
    {
        $result = $this->fetch(PDO::FETCH_OBJ);
        if ($result instanceof stdClass) {
            return $result;
        }

        return null;
    }

    public function firstToArray(): array
    {
        $data = $this->fetch(PDO::FETCH_NAMED);
        if ($data === null) {
            $data = [];
        }

        return (array) $data;
    }

    public function getLastInsertedId(): int
    {
        return $this->lastInsertedId;
    }
}
