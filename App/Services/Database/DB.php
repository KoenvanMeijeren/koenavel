<?php
declare(strict_types=1);


namespace App\Services\Database;

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
     *
     * @return DB
     */
    public static function table(string $table): DB
    {
        self::$table = $table;

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

        $this->addStatement(
            "SELECT {$columns} FROM " . self::$table . ' '
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
     * @param string $table The table to union select from
     * @param string[] ...$columns The columns to be union selected.
     *
     * @return DB
     */
    public function selectUnion(string $table, ...$columns): DB
    {
        $columns = implode(', ', $columns);

        $this->addStatement(
            "UNION SELECT {$columns} FROM {$table}"
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
     * @param string $table The table to union all select from
     * @param string[] ...$columns The columns to be union all selected.
     *
     * @return DB
     */
    public function selectUnionAll(string $table, ...$columns): DB
    {
        $columns = implode(', ', $columns);

        $this->addStatement(
            "UNION ALL SELECT {$columns} FROM {$table}"
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

        $this->addStatement(
            "SELECT DISTINCT {$columns} FROM " . self::$table . ' '
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

        $this->addStatement(
            "SELECT MIN({$columns}) FROM " . self::$table . ' '
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

        $this->addStatement(
            "SELECT MAX({$columns}) FROM " . self::$table . ' '
        );

        return $this;
    }

    /**
     * The COUNT() function returns the number of rows that matches a specified criteria.
     *
     * @param string[] ...$columns The columns to be selected.
     *
     * @return DB
     */
    public function selectCount(...$columns): DB
    {
        $columns = implode(', ', $columns);

        $this->addStatement(
            "SELECT COUNT({$columns}) FROM " . self::$table . ' '
        );

        return $this;
    }

    /**
     * The AVG() function returns the average value of a numeric column.
     *
     * @param string[] ...$columns The columns to be selected.
     *
     * @return DB
     */
    public function selectAvg(...$columns): DB
    {
        $columns = implode(', ', $columns);

        $this->addStatement(
            "SELECT AVG({$columns}) FROM " . self::$table . ' '
        );

        return $this;
    }

    /**
     * The SUM() function returns the total sum of a numeric column.
     *
     * @param string[] ...$columns The columns to be selected.
     *
     * @return DB
     */
    public function selectSum(...$columns): DB
    {
        $columns = implode(', ', $columns);

        $this->addStatement(
            "SELECT SUM({$columns}) FROM " . self::$table . ' '
        );

        return $this;
    }

    /**
     * The INNER JOIN keyword selects records that have
     * matching values in both tables.
     *
     * @param string $table The table to inner join on.
     * @param string $tableOneColumn The first table column to inner join on.
     * @param string $tableTwoColumn The second table column to inner join on.
     *
     * @return DB
     */
    public function innerJoin(
        string $table,
        string $tableOneColumn,
        string $tableTwoColumn
    ): DB {
        $this->addStatement(
            "INNER JOIN {$table} " .
            "ON {$tableOneColumn} = {$tableTwoColumn}) "
        );

        return $this;
    }

    /**
     * The LEFT JOIN keyword returns all records from the left table (table1),
     * and the matched records from the right table (table2).
     * The result is NULL from the right side, if there is no match.
     *
     * @param string $table The table to left join on.
     * @param string $tableOneColumn The first table column to left join on.
     * @param string $tableTwoColumn The second table column to left join on.
     *
     * @return DB
     */
    public function leftJoin(
        string $table,
        string $tableOneColumn,
        string $tableTwoColumn
    ): DB {
        $this->addStatement(
            "LEFT JOIN {$table} " .
            "ON {$tableOneColumn} = {$tableTwoColumn}) "
        );

        return $this;
    }

    /**
     * The RIGHT JOIN keyword returns all records from the right table (table2),
     * and the matched records from the left table (table1).
     * The result is NULL from the left side, when there is no match.
     *
     * @param string $table The table to right join on.
     * @param string $tableOneColumn The first table column to right join on.
     * @param string $tableTwoColumn The second table column to right join on.
     *
     * @return DB
     */
    public function rightJoin(
        string $table,
        string $tableOneColumn,
        string $tableTwoColumn
    ): DB {
        $this->addStatement(
            "RIGHT JOIN {$table} ON " .
            "{$tableOneColumn} = {$tableTwoColumn}) "
        );

        return $this;
    }

    /**
     * The FULL OUTER JOIN keyword return all records when
     * there is a match in either left (table1) or right (table2) table records.
     *
     * @param string $table The table to full outer join on.
     * @param string $tableOneColumn The first table column to
     *                                  full outer join on.
     * @param string $tableTwoColumn The second table column to
     *                                  full outer join on.
     *
     * @return DB
     */
    public function fullOuterJoin(
        string $table,
        string $tableOneColumn,
        string $tableTwoColumn
    ): DB {
        $this->addStatement(
            "FULL OUTER JOIN {$table} " .
            "ON {$tableOneColumn} = {$tableTwoColumn}) "
        );

        return $this;
    }

    /**
     * The WHERE clause is used to filter records.
     * The WHERE clause is used to extract only
     * those records that fulfill a specified condition.
     *
     * @param string $column    The column to specify the filter on.
     * @param string $operator  The operator to be used in the where statement.
     * @param string $condition The condition to be used in the where statement.
     *
     * @return DB
     */
    public function where(
        string $column,
        string $operator,
        string $condition
    ): DB {
        $bindColumn = str_replace('.', '', $column);

        // make sure that the bind column is unique
        if (array_key_exists($bindColumn, $this->values)) {
            $bindColumn = $bindColumn . count($this->values);
        }

        if (!strpos($this->query, 'WHERE')) {
            $this->addStatement(
                "WHERE {$column} {$operator} :{$bindColumn} "
            );
        } else {
            $this->addStatement(
                "AND {$column} {$operator} :{$bindColumn}"
            );
        }

        $this->addValues([$bindColumn => $condition]);

        return $this;
    }

    /**
     * Execute a self written query.
     *
     * @param string   $query  The query to be executed.
     * @param string[] $values The values to bind to the query.
     *
     * @return DatabaseProcessor
     *
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
     */
    public function execute(): DatabaseProcessor
    {
        $this->addHooksForInnerJoins();

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
        $this->addHooksForInnerJoins();

        return $this->query;
    }

    /**
     * Add values. These values will be used when
     *             the query is going to be executed
     *
     * @param string[] $values The values to be added
     */
    private function addValues(array $values): void
    {
        $this->values += $values;
    }

    /**
     * Get the prepared values.
     *
     * @return string[]
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * Count the inner joins in the query.
     *
     * @return int the number of full pattern matches (which might be zero)
     */
    private function countInnerJoinsInQuery(): int
    {
        return preg_match_all('/\b(JOIN)\b/', $this->query);
    }

    /**
     * Add hooks for inner joins to the query. The hooks will only be added
     * when there are inner joins used.
     *
     * This function should be called when
     * the query is going to be executed or
     * you want to get the query.
     */
    private function addHooksForInnerJoins(): void
    {
        if ($this->countInnerJoinsInQuery() === 0) {
            return;
        }

        $hooks = '';
        for ($x = 0; $x < $this->countInnerJoinsInQuery(); $x++) {
            $hooks .= '(';
        }

        $this->query = preg_replace(
            '/\b(FROM)\b/', "FROM {$hooks}", $this->query
        );

        if ($this->countInnerJoinsInQuery() === 1) {
            $this->query = preg_replace(
                '/[()]/', '', $this->query
            );
        }
    }
}
