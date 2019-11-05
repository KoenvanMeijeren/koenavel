<?php
declare(strict_types=1);


namespace App\Src\Database;


trait BasicStatements
{
    /**
     * Add a statement to the query.
     *
     * @param string $statement the statement to be added to the query
     *
     * @return DB
     */
    public abstract function addStatement(string $statement): DB;

    /**
     * Add values. These values will be used when
     *             the query is going to be executed
     *
     * @param string[] $values The values to be added
     */
    public abstract function addValues(array $values): void;

    /**
     * The HAVING clause was added to SQL because
     * the WHERE keyword could not be used with aggregate functions.
     *
     * @param string[] ...$conditions The condition(s) of the having clause.
     *
     * @return $this
     */
    public function having(...$conditions)
    {
        $conditions = implode(', ', $conditions);

        $this->addStatement(
            "HAVING {$conditions} "
        );

        return $this;
    }

    /**
     * The INSERT INTO statement is used to insert new records in a table.
     *
     * @param string[] $values The values to be inserted.
     *
     * @return $this
     */
    public function insert(array $values)
    {
        $columns = implode(', ', array_keys($values));
        $bindColumns = ':' . implode(', :', array_keys($values));

        $this->addStatement(
            "INSERT INTO " . self::$table .
            " ({$columns}) VALUES ({$bindColumns}) "
        );

        $this->addValues($values);

        return $this;
    }

    /**
     * The UPDATE statement is used to modify the existing records in a table.
     *
     * @param string[] $values The values to be updated
     *
     * @return $this
     */
    public function update(array $values)
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

        return $this;
    }

    /**
     * Soft delete records from the database.
     *
     * @param string $column The column to be updated.
     *                       This value will be used to determine
     *                       if the record has been deleted
     * @param string $value  The value -> 1 is deleted 0 -> is available
     *
     * @return $this
     */
    public function delete(string $column, string $value = '1')
    {
        $this->update([$column => $value]);

        return $this;
    }

    /**
     * The DELETE statement is used to delete existing records in a table.
     *
     * @return $this
     */
    public function permanentDelete()
    {
        $this->addStatement(
            "DELETE FROM " . self::$table . " "
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
     * @return $this
     */
    public function orderBy(string $filter, ...$columns)
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
     * @return $this
     */
    public function groupBy(...$columns)
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
     * @return $this
     */
    public function limit(int $number = 1)
    {
        $this->addStatement(
            "LIMIT {$number} "
        );

        return $this;
    }
}
