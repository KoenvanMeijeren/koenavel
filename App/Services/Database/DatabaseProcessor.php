<?php
declare(strict_types=1);


namespace App\Services\Database;

use App\Services\Exceptions\Basic\InvalidKeyException;
use PDO;
use PDOException;
use stdClass;

class DatabaseProcessor extends DatabaseConnection
{
    /**
     * Construct the data processor.
     *
     * @param string    $query  The query to execute on the database.
     * @param string[]  $values The values to bind to the query.
     *
     * @throws PDOException
     * @throws InvalidKeyException
     */
    public function __construct(string $query, array $values)
    {
        parent::__construct();

        $this->statement = $this->pdo->prepare($query);
        $this->values = $values;

        $this->bindValues($values);
        $this->statement->execute();

        $this->lastInsertedId = (int) $this->pdo->lastInsertId();
    }

    /**
     * Bind each value to the specified column in the query.
     *
     * @param string[] $values The values to bind to the query.
     *
     * @throws PDOException
     */
    private function bindValues(array $values): void
    {
        foreach ($values as $column => $value) {
            $this->statement->bindValue(
                ":{$column}", $value, PDO::PARAM_STR
            );
        }
    }


    /**
     * Fetch all records from the database with the given fetch method.
     *
     * @param int $fetchMethod The used method to fetch the database records.
     *
     * @return string[]|object
     */
    public function fetchAll(int $fetchMethod): array
    {
        $result = $this->statement->fetchAll($fetchMethod);

        return !empty($result) ? $result : [];
    }

    /**
     * Fetch one record from the database with the given fetch method.
     *
     * @param int $fetchMethod The used method to fetch the database record.
     *
     * @return string[]|object
     */
    public function fetch(int $fetchMethod)
    {
        return $this->statement->fetch($fetchMethod);
    }

    /**
     * Fetch all the records from the database to an object.
     *
     * @return object[]
     */
    public function all(): array
    {
        $result = $this->statement->fetchAll(PDO::FETCH_OBJ);

        return !empty($result) ? $result : [];
    }

    /**
     * Fetch all the records from the database to an array.
     *
     * @return string[]
     */
    public function toArray(): array
    {
        $result = $this->statement->fetchAll(PDO::FETCH_NAMED);

        return !empty($result) ? $result : [];
    }

    /**
     * Fetch the first record found in the database into an object.
     *
     * @return stdClass
     */
    public function first(): stdClass
    {
        $result = $this->statement->fetch(PDO::FETCH_OBJ);

        return !empty($result) ? $result : new stdClass();
    }

    /**
     * Fetch the first record found in the database into an array.
     *
     * @return string[]
     */
    public function firstToArray(): array
    {
        $result = $this->statement->fetch(PDO::FETCH_NAMED);

        return !empty($result) ? $result : [];
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
