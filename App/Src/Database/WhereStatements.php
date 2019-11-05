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
     * @return $this
     */
    public function where(
        string $column,
        string $operator,
        string $condition
    ) {
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
    public function whereExists(string $query, array $values)
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
     * @return $this
     */
    public function whereAny(
        string $column,
        string $operator,
        string $query,
        array $values
    ) {
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
    ) {
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
     * @return $this
     */
    public function whereNot(
        string $column,
        string $operator,
        string $condition
    ) {
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
     * @return $this
     */
    public function whereIsNull(...$columns)
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
     * @return $this
     */
    public function whereIsNotNull(...$columns)
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
     * @param string[]  ...$condition The conditions of the filter.
     *
     * @return $this
     */
    public function whereInValue(string $column, ...$condition)
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

        return $this;
    }

    /**
     * The NOT IN operator allows you to specify
     * multiple values in a WHERE clause.
     *
     * @param string    $column       The column to be filtered.
     * @param string[]  ...$condition The conditions of the filter.
     *
     * @return $this
     */
    public function whereNotInValue(string $column, ...$condition)
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

        return $this;
    }

    /**
     * Add where or statement to the query.
     *
     * @param string    $column    The column to be filtered.
     * @param string[]  ...$values The values of the filter.
     *
     * @return $this
     */
    public function whereOr(string $column, ...$values)
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
        if (strstr($this->query, 'WHERE')) {
            $query = preg_replace(
                '/\b(WHERE)\b/',
                "WHERE (",
                $query
            );
            $query .= ')';
        }

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
     * @return $this
     */
    public function whereInQuery(
        string $column,
        string $query,
        array $values
    ) {
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
    ) {
        $hook = $orStatement ? '(' : '';

        $this->addStatement(
            "WHERE {$hook} {$column} BETWEEN :{$column}Start AND :{$column}End "
        );

        $this->addValues([
            $column . 'Start' => $start,
            $column . 'End' => $end
        ]);

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
    public function whereNotBetween(
        string $column,
        string $start,
        string $end,
        bool $orStatement = false
    ) {
        $hook = $orStatement ? '(' : '';

        $this->addStatement(
            "WHERE {$hook} {$column} NOT BETWEEN :{$column}Start AND :{$column}End "
        );

        $this->addValues([
            $column . 'Start' => $start,
            $column . 'End' => $end
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
     * @return $this
     */
    public function whereOrBetween(
        string $column,
        string $start,
        string $end
    ) {
        $this->addStatement(
            "OR {$column} BETWEEN :{$column}Start AND :{$column}End "
        );

        $this->addValues([
            $column . 'Start' => $start,
            $column . 'End' => $end
        ]);

        return $this;
    }
}
