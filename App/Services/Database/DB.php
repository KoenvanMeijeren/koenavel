<?php
declare(strict_types=1);


namespace App\Services\Database;

use App\Services\Exceptions\Basic\EmptyVarException;
use App\Services\Exceptions\Basic\InvalidKeyException;
use PDOException;

final class DB
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
     * @var mixed[]
     */
    private $values = [];

    /**
     * Set the table.
     *
     * @param string $table The table to execute the query on.
     * @param int $quantityInnerJoins The quantity inner joins in the query.
     *
     * @return DB
     */
    public static function table(string $table, int $quantityInnerJoins = 0): DB
    {
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
     */
    public function select(...$columns): DB
    {
        $columns = implode(', ', $columns);
        $hooks = '';
        for ($x = 0; $x < self::$quantityInnerJoins; $x++) {
            $hooks .= '(';
        }

        $this->addStatement(
            "SELECT {$columns} FROM {$hooks}" . self::$table . ' '
        );

        return $this;
    }

    /**
     * The UNION operator is used to combine the result-set of
     * two or more SELECT statements.
     * - Each SELECT statement within UNION must have the same number of columns
     * - The columns must also have similar data types
     * - The columns in each SELECT statement must also be in the same order
     *
     * The UNION operator selects only distinct values by default.
     * To allow duplicate values, use UNION ALL:
     *
     * @param string    $table         The table to union select from
     * @param string[]  ...$columns    The columns to be union selected.
     *
     * @return DB
     */
    public function selectUnion(string $table, ...$columns): DB
    {
        $columns = implode(', ', $columns);
        $hooks = '';
        for ($x = 0; $x < self::$quantityInnerJoins; $x++) {
            $hooks .= '(';
        }

        $this->addStatement(
            "UNION SELECT {$columns} FROM {$hooks} {$table}"
        );

        return $this;
    }

    /**
     * The UNION operator is used to combine the result-set of
     * two or more SELECT statements.
     * - Each SELECT statement within UNION must have the same number of columns
     * - The columns must also have similar data types
     * - The columns in each SELECT statement must also be in the same order
     *
     * The UNION operator selects only distinct values by default.
     * To allow duplicate values, use UNION ALL:
     *
     * @param string    $table      The table to union all select from
     * @param string[]  ...$columns The columns to be union all selected.
     *
     * @return DB
     */
    public function selectUnionAll(string $table, ...$columns): DB
    {
        $columns = implode(', ', $columns);
        $hooks = '';
        for ($x = 0; $x < self::$quantityInnerJoins; $x++) {
            $hooks .= '(';
        }

        $this->addStatement(
            "UNION ALL SELECT {$columns} FROM {$hooks} {$table}"
        );

        return $this;
    }

    /**
     * The SELECT DISTINCT statement is used to
     * return only distinct (different) values.
     *
     * @param string[] ...$columns The columns to select distinct.
     *
     * @return DB
     */
    public function selectDistinct(...$columns): DB
    {
        $columns = implode(', ', $columns);
        $hooks = '';
        for ($x = 0; $x < self::$quantityInnerJoins; $x++) {
            $hooks .= '(';
        }

        $this->addStatement(
            "SELECT DISTINCT {$columns} FROM {$hooks}".self::$table.' '
        );

        return $this;
    }

    /**
     * The MIN() function returns the smallest value of the selected column.
     *
     * @param string[] ...$columns The columns to be selected.
     *
     * @return DB
     */
    public function selectMin(...$columns): DB
    {
        $columns = implode(', ', $columns);
        $hooks = '';
        for ($x = 0; $x < self::$quantityInnerJoins; $x++) {
            $hooks .= '(';
        }

        $this->addStatement(
            "SELECT MIN({$columns}) FROM {$hooks}" . self::$table . ' '
        );

        return $this;
    }

    /**
     * The MAX() function returns the largest value of the selected column.
     *
     * @param string[] ...$columns The columns to be selected.
     *
     * @return DB
     */
    public function selectMax(...$columns): DB
    {
        $columns = implode(', ', $columns);
        $hooks = '';
        for ($x = 0; $x < self::$quantityInnerJoins; $x++) {
            $hooks .= '(';
        }

        $this->addStatement(
            "SELECT MAX({$columns}) FROM {$hooks}".self::$table.' '
        );

        return $this;
    }

    /**
     * The COUNT() function returns the number of rows that matches a specified criteria.
     *
     * @param mixed ...$columns The columns to be selected.
     *
     * @return DB
     */
    public function selectCount(...$columns): DB
    {
        $columns = implode(', ', $columns);
        $hooks = '';
        for ($x = 0; $x < self::$quantityInnerJoins; $x++) {
            $hooks .= '(';
        }

        $this->addStatement(
            "SELECT COUNT({$columns}) FROM {$hooks}".self::$table.' '
        );

        return $this;
    }

    /**
     * Execute a self written query.
     *
     * @param string    $query  The query to be executed.
     * @param mixed[]   $values The values to bind to the query.
     *
     * @return DatabaseProcessor
     *
     * @throws EmptyVarException
     * @throws InvalidKeyException
     */
    public static function query(
        string $query,
        array $values = []
    ): DatabaseProcessor {
        return new DatabaseProcessor($query, $values);
    }

    /**
     * Execute the prepared query.
     *
     * @return DatabaseProcessor
     *
     * @throws InvalidKeyException
     * @throws PDOException
     * @throws EmptyVarException
     */
    public function execute(): DatabaseProcessor
    {
        return new DatabaseProcessor($this->query, $this->values);
    }

    /**
     * Add a statement to the query.
     *
     * @param string $statement the statement to be added to the query
     */
    private function addStatement(string $statement): void
    {
        $this->query .= $statement;
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
     * Add values. These values will be used when
     *             the query is going to be executed
     *
     * @param mixed[] $values The values to be added
     */
    private function addValues(array $values): void
    {
        if (!empty($values)) {
            $this->values += $values;
        }
    }

    /**
     * Get the prepared values.
     *
     * @return mixed[]
     */
    public function getValues(): array
    {
        return $this->values;
    }
}
