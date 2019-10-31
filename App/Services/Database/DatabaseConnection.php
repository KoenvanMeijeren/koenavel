<?php
declare(strict_types=1);


namespace App\Services\Database;

use App\Services\Config\Config;
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
     */
    protected function __construct()
    {
        $config = new Config();

        $dsn = $config->get('databaseServer')->toString() . ';';
        $dbName = 'dbname=' . $config->get('databaseName')->toString() . ';';
        $charset = 'charset' . $config->get('databaseCharset')->toString().';';

        $this->pdo = new PDO(
            $dsn . $dbName . $charset,
            $config->get('databaseUsername')->toString(),
            $config->get('databasePassword')->toString(),
            $config->get('databaseOptions')->toArray()
        );
    }
}
