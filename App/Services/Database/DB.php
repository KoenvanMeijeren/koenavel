<?php
declare(strict_types=1);


namespace App\Services\Database;


use App\Services\Exceptions\Basic\EmptyVarException;
use App\Services\Exceptions\Basic\InvalidKeyException;
use App\Services\Exceptions\Basic\InvalidTypeException;
use App\Services\Exceptions\Object\InvalidObjectException;
use App\Services\Validate\Validate;
use PDOException;

class DB
{
    /**
     * The table to execute the query on.
     *
     * @var string
     */
    private static $table = '';

    /**
     * The quantity of inner joins in the query.
     *
     * @var int
     */
    private static $quantityInnerJoins = 0;

    /**
     * The query.
     *
     * @var string
     */
    private $query = '';

    /**
     * The values to bind to the query.
     *
     * @var array
     */
    private $values = [];

    /**
     * Set the table.
     *
     * @param string $table The table to execute the query on.
     * @param int $quantityInnerJoins The quantity inner joins in the query.
     *
     * @return DB
     * @throws InvalidTypeException
     * @throws EmptyVarException
     */
    public static function table(string $table, int $quantityInnerJoins = 0): DB
    {
        Validate::var($table)->isString()->isNotEmpty();
        Validate::var($quantityInnerJoins)->isInt()->isNotEmpty();

        self::$table = $table;
        self::$quantityInnerJoins = $quantityInnerJoins;

        return new self;
    }

    /**
     * The SELECT statement is used to select data from a database.
     * The data returned is stored in a result table, called the result-set.
     *
     * @param string[] ...$columns The columns to select from the database.
     *
     * @return DB
     * @throws EmptyVarException
     * @throws InvalidTypeException
     */
    public function select(... $columns): DB
    {
        $columns = implode(', ', $columns);
        $hooks = '';
        for ($x = 0; $x < self::$quantityInnerJoins; $x++) {
            $hooks .= '(';
        }

        Validate::var($columns)->isString()->isNotEmpty();
        $this->query .= "SELECT {$columns} FROM {$hooks}" . self::$table . ' ';

        return $this;
    }

    /**
     * Execute self written queries.
     *
     * @param string $query  The query to execute.
     * @param array  $values The values to bind to the query.
     *
     * @return DB
     * @throws InvalidTypeException
     * @throws EmptyVarException
     */
    public function query(string $query, array $values = []): DB
    {
        Validate::var($query)->isString()->isNotEmpty();
        Validate::var($values)->isArray();

        $this->query = $query;
        if (!empty($this->values) && is_array($values)) {
            $this->values += $values;
        }

        return $this;
    }

    /**
     * Get the prepared query.
     *
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * Get the prepared values.
     *
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * Execute the query if the query is prepared.
     *
     * @return DatabaseProcessor
     * @throws EmptyVarException
     * @throws InvalidTypeException
     * @throws InvalidKeyException
     * @throws InvalidObjectException
     * @throws PDOException
     */
    public function execute(): DatabaseProcessor
    {
        Validate::var($this->query)->isString()->isNotEmpty();
        Validate::var($this->values)->isArray();

        return new DatabaseProcessor($this->query, $this->values);
    }
}
