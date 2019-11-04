<?php
declare(strict_types=1);


namespace App\Src\Database;


trait SelectStatements
{
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

        return new DB();
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

        return new DB();
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

        return new DB();
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

        return new DB();
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

        return new DB();
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

        return new DB();
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

        return new DB();
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

        return new DB();
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

        return new DB();
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

        return new DB();
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

        return new DB();
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

        return new DB();
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

        return new DB();
    }
}
