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
     * @param string $table         The table to union select from
     * @param string[] ...$columns  The columns to be union selected.
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
     * @param string $table         The table to union all select from
     * @param string[] ...$columns  The columns to be union all selected.
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
     * The COUNT() function returns the number of
     * rows that matches the specified criteria.
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
     * @param string $table          The table to inner join on.
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
     * @param string $table           The table to left join on.
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
     * @param string $table           The table to right join on.
     * @param string $tableOneColumn  The first table column to right join on.
     * @param string $tableTwoColumn  The second table column to right join on.
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
     * @param string $table             The table to full outer join on.
     * @param string $tableOneColumn    The first table column to
     *                                  full outer join on.
     * @param string $tableTwoColumn    The second table column to
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

        $this->addStatement(
            "WHERE {$column} {$operator} :{$bindColumn} "
        );
        $this->addValues([$bindColumn => $condition]);

        return $this;
    }

    /**
     * The EXISTS operator is used to test for
     * the existence of any record in a sub query.
     * The EXISTS operator returns true if the sub
     * query returns one or more records.
     *
     * @param string    $query  The query to test if any record exists.
     * @param string[]  $values The values to bind to the query.
     *
     * @return $this
     */
    public function whereExists(string $query, array $values): DB
    {
        $this->addStatement(
            "WHERE EXISTS ({$query}) "
        );

        foreach ($values as $column => $value) {
            $this->addValues([$column => $value]);
        }

        return $this;
    }

    /**
     * The ANY and ALL operators are used with a WHERE or HAVING clause.
     *
     * The ANY operator returns true if any of
     * the sub query values meet the condition.
     *
     * The ALL operator returns true if all of
     * the sub query values meet the condition.
     *
     * @param string    $column   The column to be filtered.
     * @param string    $operator The operator.
     * @param string    $query    The query which checks if all of the values
     *                            meet the condition.
     * @param string[]  $values   The values to bind to the query.
     *
     * @return DB
     */
    public function whereAny(
        string $column,
        string $operator,
        string $query,
        array $values
    ): DB {
        $this->addStatement(
            "WHERE {$column} {$operator} ANY ({$query}) "
        );

        foreach ($values as $column => $value) {
            $this->addValues([$column => $value]);
        }

        return $this;
    }

    /**
     * The ANY and ALL operators are used with a WHERE or HAVING clause.
     *
     * The ANY operator returns true if any of
     * the sub query values meet the condition.
     *
     * The ALL operator returns true if all of
     * the sub query values meet the condition.
     *
     * @param string    $column   The column to be filtered.
     * @param string    $operator The operator.
     * @param string    $query    The query which checks if all of the
     *                            sub query values meet the condition.
     * @param string[]  $values   The values to bind to the query.
     *
     * @return $this
     */
    public function whereAll(
        string $column,
        string $operator,
        string $query,
        array $values
    ): DB {
        $this->addStatement(
            "WHERE {$column} {$operator} ALL ({$query}) "
        );

        foreach ($values as $column => $value) {
            $this->addValues([$column => $value]);
        }

        return $this;
    }

    /**
     * Add where not statement to the query.
     *
     * @param string $column    The column to be filtered.
     * @param string $operator  The operator.
     * @param string $condition The condition of the filter.
     *
     * @return DB
     */
    public function whereNot(
        string $column,
        string $operator,
        string $condition
    ): DB {
        $this->addStatement(
            "WHERE NOT {$column} {$operator} :{$column} "
        );

        $this->addValues([$column => $condition]);

        return $this;
    }

    /**
     * The IS NULL operator is used to test for empty values (NULL values).
     *
     * @param string[] ...$columns The columns to be filtered.
     *
     * @return DB
     */
    public function whereIsNull(...$columns): DB
    {
        $columns = implode(', ', $columns);

        $this->addStatement(
            "WHERE {$columns} IS NULL "
        );

        return $this;
    }

    /**
     * The IS NOT NULL operator is used to test for empty values (NULL values).
     *
     * @param string[] ...$columns The columns to be filtered.
     *
     * @return DB
     */
    public function whereIsNotNull(...$columns): DB
    {
        $columns = implode(', ', $columns);

        $this->addStatement(
            "WHERE {$columns} IS NOT NULL "
        );

        return $this;
    }

    /**
     * The IN operator allows you to specify multiple values in a WHERE clause.
     *
     * @param string    $column       The column to be filtered.
     * @param string[]  ...$condition The condition of the filter.
     *
     * @return DB
     */
    public function whereInValue(string $column, ...$condition): DB
    {
        $this->addStatement(
            "WHERE {$column} IN (:{$column}) "
        );

        $this->addValues([$column => $condition]);

        return $this;
    }

    /**
     * The NOT IN operator allows you to specify
     * multiple values in a WHERE clause.
     *
     * @param string    $column       The column to be filtered.
     * @param string[]  ...$condition The condition of the filter.
     *
     * @return DB
     */
    public function whereNotInValue(string $column, ...$condition): DB
    {
        $this->addStatement(
            "WHERE {$column} NOT IN (:{$column}) "
        );

        $this->addValues([$column => $condition]);

        return $this;
    }

    /**
     * Add where or statement to the query.
     *
     * @param string    $column    The column to be filtered.
     * @param string[]  ...$values The values of the filter.
     *
     * @return DB
     */
    public function whereOr(string $column, ...$values): DB
    {
        $query = '';
        foreach ($values as $key => $value) {
            if (!strpos($this->query, 'WHERE')) {
                if (!strpos($query, 'OR')) {
                    $query .= "WHERE ({$column} = :" . $column . $key . " ";
                } else {
                    $query .= " OR {$column} = :" . $column . $key . " ";
                }
            }

            if (!strpos($query, 'OR')) {
                $query .= "AND ({$column} = :" . $column . $key . " OR ";
            } else {
                $query .= "{$column} = :" . $column . $key . " ";
            }

            $this->addValues([$column . $key => $value]);
        }
        $query .= ') ';

        $this->addStatement($query);

        return $this;
    }

    /**
     * The IN operator allows you to specify multiple values in a WHERE clause.
     *
     * @param string    $column The column to be filtered.
     * @param string    $query  The query to be used as a filter.
     * @param string[]  $values The values of the sub query.
     *
     * @return DB
     */
    public function whereInQuery(
        string $column,
        string $query,
        array $values
    ): DB {
        $this->addStatement(
            "WHERE {$column} IN ({$query}) "
        );

        foreach ($values as $key => $value) {
            $this->addValues([$key => $value]);
        }

        return $this;
    }

    /**
     * The BETWEEN operator selects values within a given range.
     * The values can be numbers, text, or dates.
     * The BETWEEN operator is inclusive: begin and end values are included.
     *
     * @param string $column        The column to be filtered.
     * @param string $start         The start range of the filter.
     * @param string $end           The end range of the filter.
     * @param bool   $orStatement   Determine if there must be a
     *                              hook added to the query.
     *
     * @return $this
     */
    public function whereBetween(
        string $column,
        string $start,
        string $end,
        bool $orStatement = false
    ): DB {
        $hook = $orStatement ? '(' : '';

        $this->addStatement(
            "WHERE {$hook} {$column} BETWEEN :{$column}start AND :{$column}end "
        );

        $this->addValues([
            $column . 'start' => $start,
            $column . 'end' => $end
        ]);

        return $this;
    }

    /**
     * The BETWEEN operator selects values within a given range.
     * The values can be numbers, text, or dates.
     * The BETWEEN operator is inclusive: begin and end values are included.
     *
     * @param string $column    The columns to be filtered.
     * @param string $start     The start range of the filter.
     * @param string $end       The end range of the filter.
     *
     * @return DB
     */
    public function whereOrBetween(
        string $column,
        string $start,
        string $end
    ): DB {
        $this->addStatement(
            "OR {$column} BETWEEN :{$column}start AND :{$column}end )"
        );

        $this->addValues([
            $column . 'start' => $start,
            $column . 'end' => $end
        ]);

        return $this;
    }

    /**
     * The HAVING clause was added to SQL because
     * the WHERE keyword could not be used with aggregate functions.
     *
     * @param string[] ...$conditions The condition(s) of the having clause.
     *
     * @return DB
     */
    public function having(...$conditions): DB
    {
        $conditions = implode(', ', $conditions);

        $this->addStatement(
            "HAVING {$conditions}"
        );

        return $this;
    }

    /**
     * The INSERT INTO statement is used to insert new records in a table.
     *
     * @param string[] $values The values to be inserted.
     *
     * @return DB
     */
    public function insert(array $values): DB
    {
        $columns = array_keys($values);
        $this->addStatement(
            "INSERT INTO " . self::$table .
            " (`" . implode('`, `', $columns) . "`)" .
            " VALUES (:" . implode(', :', $columns) . ") "
        );

        $this->addValues($values);

        return $this;
    }

    /**
     * The UPDATE statement is used to modify the existing records in a table.
     *
     * @param string[] $values The values to be updated
     *
     * @return DB
     */
    public function update(array $values): DB
    {
        $columns = array_keys($values);
        $lastColumn = array_key_last($values);

        $this->addStatement(
            "UPDATE " . self::$table . " SET "
        );

        foreach ($columns as $column) {
            if ($lastColumn !== $column) {
                $this->addStatement(
                    "{$column} = :{$column}, "
                );
            } else {
                $this->addStatement(
                    "{$column} = :{$column} "
                );
            }
        }

        $this->addValues($values);

        return $this;
    }

    /**
     * Soft delete records from the database.
     *
     * @param string $column The column to be updated.
     *                       This value will be used to determine
     *                       if the record has been deleted
     * @param int    $value  The value -> 1 is deleted 0 -> is available
     *
     * @return DB
     */
    public function delete(string $column, int $value = 1): DB
    {
        $this->update([$column => $value]);

        return $this;
    }

    /**
     * The DELETE statement is used to delete existing records in a table.
     *
     * @return DB
     */
    public function permanentDelete(): DB
    {
        $this->addStatement(
            "DELETE FROM " . self::$_table . " "
        );

        return $this;
    }

    /**
     * Order all selected records by specified columns with a specified filter.
     *
     * @param string    $filter     The filter
     *                                  -> ascending (asc) or descending (desc).
     * @param string[]  ...$columns The columns to be ordered.
     *
     * @return DB
     */
    public function orderBy(string $filter, ...$columns): DB
    {
        $columns = implode(', ', $columns);

        $this->addStatement(
            "ORDER BY {$columns} {$filter} "
        );

        return $this;
    }

    /**
     * The GROUP BY statement is used to group the
     * result-set by one or more columns.
     *
     * @param string[] ...$columns The columns to be grouped into one record
     *
     * @return DB
     */
    public function groupBy(...$columns): DB
    {
        $columns = implode(', ', $columns);

        $this->addStatement(
            "GROUP BY {$columns} "
        );

        return $this;
    }

    /**
     * Limit the number of records that are selected from the database.
     *
     * @param int $number The maximum number of selected records.
     *
     * @return DB
     */
    public function limit(int $number = 1): DB
    {
        $this->addStatement(
            "LIMIT {$number} "
        );

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
        if (strpos($this->query, 'WHERE')) {
            $statement = preg_replace(
                '/\b(WHERE)\b/', "AND", $statement
            );
        }

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
