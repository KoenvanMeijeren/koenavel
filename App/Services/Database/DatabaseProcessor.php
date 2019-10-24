<?php
declare(strict_types=1);


namespace App\Services\Database;


use App\Services\Exceptions\Basic\EmptyVarException;
use App\Services\Exceptions\Basic\InvalidKeyException;
use App\Services\Validate\Validate;
use PDO;
use PDOException;
use PDOStatement;
use stdClass;

class DatabaseProcessor extends DatabaseConnection
{
    /**
     * Construct the data processor.
     *
     * @param string $query The query to execute on the database.
     * @param string[] $values The values to bind to the query.
     *
     * @throws PDOException
     * @throws InvalidKeyException
     * @throws EmptyVarException
     */
    public function __construct(string $query, array $values)
    {
        parent::__construct();
        Validate::var($query)->isNotEmpty();

        $this->statement = $this->pdo->prepare($query);
        $this->values = $values;

        $this->bindValues($values);
        $this->statement->execute();

        $this->lastInsertedId = (int)$this->pdo->lastInsertId();
    }

    /**
     * Bind each value to the specified column in the query.
     *
     * @param string[] $values The values to bind to the query.
     *
     * @return PDOStatement
     * @throws PDOException
     * @throws EmptyVarException
     */
    private function bindValues(array $values): PDOStatement
    {
        foreach ($values as $column => $value) {
            Validate::var($column)->isNotEmpty();
            Validate::var($value)->isNotEmpty();

            $this->statement->bindValue(
                ":{$column}", $values, PDO::PARAM_STR
            );
        }

        return $this->statement;
    }


    /**
     * Fetch all records from the database with the given fetch method.
     *
     * @param int $fetchMethod The used method to fetch the database records.
     *
     * @return mixed[]
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
     * @return mixed
     */
    public function fetch(int $fetchMethod)
    {
        return $this->statement->fetch($fetchMethod);
    }

    /**
     * Fetch all the records from the database to an object.
     *
     * @return mixed[]
     */
    public function all(): array
    {
        $result = $this->statement->fetchAll(PDO::FETCH_OBJ);

        return !empty($result) ? $result : [];
    }

    /**
     * Fetch all the records from the database to an array.
     *
     * @return mixed[]
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
     * @return mixed[]
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
