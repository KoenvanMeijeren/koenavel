<?php
declare(strict_types=1);


namespace App\Services\Database;


use App\Services\Core\Config;
use App\Services\Exceptions\Basic\InvalidKeyException;
use App\Services\Exceptions\Basic\InvalidTypeException;
use App\Services\Exceptions\Object\InvalidObjectException;
use App\Services\Validate\Validate;
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
     * Determine if the executing of the query successfully has been done.
     *
     * @var bool
     */
    protected $successful = false;

    /**
     * Construct the database connection.
     *
     * @throws InvalidObjectException
     * @throws InvalidKeyException
     * @throws InvalidTypeException
     */
    protected function __construct()
    {
        $dsn = Config::get('databaseServer')->toString() . ';';
        $dbName = 'dbname=' . Config::get('databaseName')->toString() . ';';
        $charset = 'charset' . Config::get('databaseCharset')->toString().';';

        $pdo = new PDO($dsn . $dbName . $charset,
            Config::get('databaseUsername')->toString(),
            Config::get('databasePassword')->toString(),
            Config::get('databaseOptions')->toArray()
        );
        Validate::var($pdo)->isObject();

        $this->pdo = $pdo;
    }
}
