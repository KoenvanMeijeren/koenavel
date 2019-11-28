<?php
declare(strict_types=1);


namespace App\Src\Database;

use App\Src\Config\Config;
use App\Src\Exceptions\Basic\InvalidKeyException;
use PDO;
use PDOException;
use PDOStatement;

abstract class DatabaseConnection
{
    /**
     * The PDO class.
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * The PDO statement class.
     *
     * @var PDOStatement
     */
    protected $statement;

    /**
     * The values to bind to the query.
     *
     * @var string[]
     */
    protected $values = [];

    /**
     * The last inserted ID.
     *
     * @var int
     */
    protected $lastInsertedId = 0;

    /**
     * The message which is returned when the query is executed.
     *
     * @var string
     */
    protected $message = '';

    /**
     * Connect with the database and execute the query.
     *
     * @param string    $query  The query to execute
     * @param string[]  $values The values to bind to the query
     */
    final public function __construct(string $query, array $values)
    {
        $config = new Config();

        try {
            $dsn = $config->get('databaseServer')->toString() . ';';
            $dbName = 'dbname=' . $config->get('databaseName')->toString() . ';';
            $charset = 'charset' . $config->get('databaseCharset')->toString().';';

            $this->pdo = new PDO(
                $dsn . $dbName . $charset,
                $config->get('databaseUsername')->toString(),
                $config->get('databasePassword')->toString(),
                $config->get('databaseOptions')->toArray()
            );
        } catch (InvalidKeyException $e) {
            throw new PDOException($e->getMessage(), $e->getCode(), $e);
        }

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
     * @codeCoverageIgnore
     */
    abstract protected function bindValues(array $values): void;

    /**
     * Fetch all records from the database with the given fetch method.
     *
     * @param int $fetchMethod The used method to fetch the database records.
     *
     * @return string[]|object[]
     */
    abstract public function fetchAll(int $fetchMethod): array;

    /**
     * Fetch one record from the database with the given fetch method.
     *
     * @param int $fetchMethod The used method to fetch the database record.
     *
     * @return string[]|object
     */
    abstract public function fetch(int $fetchMethod);
}
