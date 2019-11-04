<?php
declare(strict_types=1);


namespace App\Src\Database;


trait WhereStatements
{
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

        return new DB();
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
     * @return DB
     */
    public function whereExists(string $query, array $values): DB
    {
        $this->addStatement(
            "WHERE EXISTS ({$query}) "
        );

        foreach ($values as $column => $value) {
            $this->addValues([$column => $value]);
        }

        return new DB();
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

        return new DB();
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
     * @return DB
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

        return new DB();
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

        return new DB();
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

        return new DB();
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

        return new DB();
    }

    /**
     * The IN operator allows you to specify multiple values in a WHERE clause.
     *
     * @param string    $column       The column to be filtered.
     * @param string[]  ...$condition The conditions of the filter.
     *
     * @return DB
     */
    public function whereInValue(string $column, ...$condition): DB
    {
        $bindColumns = [];
        foreach ($condition as $key => $value) {
            array_push($bindColumns, $column.$key);

            $this->addValues([$column.$key => $value]);
        }

        $bindColumns = ':' . implode(', :', $bindColumns);

        $this->addStatement(
            "WHERE {$column} IN ({$bindColumns}) "
        );

        return new DB();
    }

    /**
     * The NOT IN operator allows you to specify
     * multiple values in a WHERE clause.
     *
     * @param string    $column       The column to be filtered.
     * @param string[]  ...$condition The conditions of the filter.
     *
     * @return DB
     */
    public function whereNotInValue(string $column, ...$condition): DB
    {
        $bindColumns = [];
        foreach ($condition as $key => $value) {
            array_push($bindColumns, $column.$key);

            $this->addValues([$column.$key => $value]);
        }

        $bindColumns = ':' . implode(', :', $bindColumns);

        $this->addStatement(
            "WHERE {$column} NOT IN ({$bindColumns}) "
        );

        return new DB();
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
            $bindColumn = $column.$key;

            $this->addValues([$bindColumn => $value]);

            if (strstr($query, 'WHERE')) {
                $query .= "OR {$column} = :{$bindColumn} ";
            } else {
                $query .= "WHERE {$column} = :{$bindColumn} ";
            }
        }

        // add hooks to the query if there is already a where statement added
        if (strstr(self::$query, 'WHERE')) {
            $query = preg_replace(
                '/\b(WHERE)\b/',
                "WHERE (",
                $query
            );
            $query .= ')';
        }

        $this->addStatement($query);

        return new DB();
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

        return new DB();
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
     * @return DB
     */
    public function whereBetween(
        string $column,
        string $start,
        string $end,
        bool $orStatement = false
    ): DB {
        $hook = $orStatement ? '(' : '';

        $this->addStatement(
            "WHERE {$hook} {$column} BETWEEN :{$column}Start AND :{$column}End "
        );

        $this->addValues([
            $column . 'Start' => $start,
            $column . 'End' => $end
        ]);

        return new DB();
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
     * @return DB
     */
    public function whereNotBetween(
        string $column,
        string $start,
        string $end,
        bool $orStatement = false
    ): DB {
        $hook = $orStatement ? '(' : '';

        $this->addStatement(
            "WHERE {$hook} {$column} NOT BETWEEN :{$column}Start AND :{$column}End "
        );

        $this->addValues([
            $column . 'Start' => $start,
            $column . 'End' => $end
        ]);

        return new DB();
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
            "OR {$column} BETWEEN :{$column}Start AND :{$column}End "
        );

        $this->addValues([
            $column . 'Start' => $start,
            $column . 'End' => $end
        ]);

        return new DB();
    }
}
