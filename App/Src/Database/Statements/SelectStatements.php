<?php
declare(strict_types=1);


namespace App\Src\Database\Statements;

use App\Src\Database\DB;

trait SelectStatements
{
    /**
     * Add a statement to the query.
     *
     * @param string $statement the statement to be added to the query
     *
     * @return DB
     */
    abstract public function addStatement(string $statement): DB;

    /**
     * Add values. These values will be used when
     *             the query is going to be executed
     *
     * @param string[] $values The values to be added
     */
    abstract public function addValues(array $values): void;

    /**
     * The SELECT statement is used to select data from a database.
     * The data returned is stored in a result table, called the result-set.
     *
     * @param string[] ...$columns The columns to select from the database.
     *
     * @return $this
     */
    public function select(...$columns): self
    {
        $queryColumns = implode(', ', $columns);

        $this->addStatement(
            "SELECT {$queryColumns} FROM " . self::$table . ' '
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
     * @return $this
     */
    public function selectUnion(string $table, ...$columns): self
    {
        $queryColumns = implode(', ', $columns);

        $this->addStatement(
            "UNION SELECT {$queryColumns} FROM {$table}"
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
     * @return $this
     */
    public function selectUnionAll(string $table, ...$columns): self
    {
        $queryColumns = implode(', ', $columns);

        $this->addStatement(
            "UNION ALL SELECT {$queryColumns} FROM {$table}"
        );

        return $this;
    }

    /**
     * The SELECT DISTINCT statement is used to
     * return only distinct (different) values.
     *
     * @param string[] ...$columns The columns to select distinct.
     *
     * @return $this
     */
    public function selectDistinct(...$columns): self
    {
        $queryColumns = implode(', ', $columns);

        $this->addStatement(
            "SELECT DISTINCT {$queryColumns} FROM " . self::$table . ' '
        );

        return $this;
    }

    /**
     * The MIN() function returns the smallest value of the selected column.
     *
     * @param string[] ...$columns The columns to be selected.
     *
     * @return $this
     */
    public function selectMin(...$columns): self
    {
        $queryColumns = implode(', ', $columns);

        $this->addStatement(
            "SELECT MIN({$queryColumns}) FROM " . self::$table . ' '
        );

        return $this;
    }

    /**
     * The MAX() function returns the largest value of the selected column.
     *
     * @param string[] ...$columns The columns to be selected.
     *
     * @return $this
     */
    public function selectMax(...$columns): self
    {
        $queryColumns = implode(', ', $columns);

        $this->addStatement(
            "SELECT MAX({$queryColumns}) FROM " . self::$table . ' '
        );

        return $this;
    }

    /**
     * The COUNT() function returns the number of
     * rows that matches the specified criteria.
     *
     * @param string[] ...$columns The columns to be selected.
     *
     * @return $this
     */
    public function selectCount(...$columns): self
    {
        $queryColumns = implode(', ', $columns);

        $this->addStatement(
            "SELECT COUNT({$queryColumns}) FROM " . self::$table . ' '
        );

        return $this;
    }

    /**
     * The AVG() function returns the average value of a numeric column.
     *
     * @param string[] ...$columns The columns to be selected.
     *
     * @return $this
     */
    public function selectAvg(...$columns): self
    {
        $queryColumns = implode(', ', $columns);

        $this->addStatement(
            "SELECT AVG({$queryColumns}) FROM " . self::$table . ' '
        );

        return $this;
    }

    /**
     * The SUM() function returns the total sum of a numeric column.
     *
     * @param string[] ...$columns The columns to be selected.
     *
     * @return $this
     */
    public function selectSum(...$columns): self
    {
        $queryColumns = implode(', ', $columns);

        $this->addStatement(
            "SELECT SUM({$queryColumns}) FROM " . self::$table . ' '
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
     * @return $this
     */
    public function innerJoin(
        string $table,
        string $tableOneColumn,
        string $tableTwoColumn
    ): self {
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
     * @return $this
     */
    public function leftJoin(
        string $table,
        string $tableOneColumn,
        string $tableTwoColumn
    ): self {
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
     * @return $this
     */
    public function rightJoin(
        string $table,
        string $tableOneColumn,
        string $tableTwoColumn
    ): self {
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
     * @return $this
     */
    public function fullOuterJoin(
        string $table,
        string $tableOneColumn,
        string $tableTwoColumn
    ): self {
        $this->addStatement(
            "FULL OUTER JOIN {$table} " .
            "ON {$tableOneColumn} = {$tableTwoColumn}) "
        );

        return $this;
    }
}
