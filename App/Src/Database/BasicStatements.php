<?php
declare(strict_types=1);


namespace App\Src\Database;


trait BasicStatements
{
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
            "HAVING {$conditions} "
        );

        return new DB();
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
        $columns = implode(', ', array_keys($values));
        $bindColumns = ':' . implode(', :', array_keys($values));

        $this->addStatement(
            "INSERT INTO " . self::$table .
            " ({$columns}) VALUES ({$bindColumns}) "
        );

        $this->addValues($values);

        return new DB();
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
        $this->addStatement(
            "UPDATE " . self::$table . " SET "
        );

        foreach (array_keys($values) as $column) {
            $comma = array_key_last($values) !== $column ? ',' : '';

            $this->addStatement(
                "{$column} = :{$column}{$comma} "
            );
        }

        $this->addValues($values);

        return new DB();
    }

    /**
     * Soft delete records from the database.
     *
     * @param string $column The column to be updated.
     *                       This value will be used to determine
     *                       if the record has been deleted
     * @param string $value  The value -> 1 is deleted 0 -> is available
     *
     * @return DB
     */
    public function delete(string $column, string $value = '1'): DB
    {
        $this->update([$column => $value]);

        return new DB();
    }

    /**
     * The DELETE statement is used to delete existing records in a table.
     *
     * @return DB
     */
    public function permanentDelete(): DB
    {
        $this->addStatement(
            "DELETE FROM " . self::$table . " "
        );

        return new DB();
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

        return new DB();
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

        return new DB();
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

        return new DB();
    }
}
