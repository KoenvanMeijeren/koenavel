<?php
declare(strict_types=1);


namespace App\Services\Database;


use App\Services\Core\Config;
use App\Services\Exceptions\Basic\InvalidKeyException;
use PDO;
use PDOStatement;

class DatabaseConnection
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
     * Construct the database connection.
     *
     * @throws InvalidKeyException
     */
    protected function __construct()
    {
        $dsn = Config::get('databaseServer')->toString() . ';';
        $dbName = 'dbname=' . Config::get('databaseName')->toString() . ';';
        $charset = 'charset' . Config::get('databaseCharset')->toString().';';

        $this->pdo = new PDO($dsn . $dbName . $charset,
            Config::get('databaseUsername')->toString(),
            Config::get('databasePassword')->toString(),
            Config::get('databaseOptions')->toArray()
        );
    }
}
