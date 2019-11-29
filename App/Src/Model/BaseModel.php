<?php
declare(strict_types=1);


namespace App\Src\Model;

use App\Src\Database\DB;
use stdClass;

abstract class BaseModel
{
    protected string $table = '';
    protected string $columns = '*';
    protected string $idColumn = 'ID';
    protected string $softDeleteColumn = '';

    protected int $id = 0;

    private array $filters = [];
    private array $filterValues = [];

    private array $fields = [];

    /**
     * Get data from the specified table.
     *
     * @return stdClass
     */
    protected function get(): stdClass
    {
        $data = DB::table($this->table)
            ->select($this->columns)
            ->where($this->idColumn, '=', (string) $this->id)
            ->execute()
            ->first();

        return $data;
    }

    /**
     * Get a record by a specified filter.
     *
     * @return stdClass
     */
    protected function getBy(): stdClass
    {
        $data = DB::table($this->table)
            ->select($this->columns)
            ->addStatementWithValues(
                $this->convertFiltersToStatement(),
                $this->filterValues
            )
            ->execute()
            ->first();

        $this->reset();

        return $data;
    }

    /**
     * Get all records from the table.
     *
     * @return object[]
     */
    protected function getAll(): array
    {
        $data = DB::table($this->table)
            ->select($this->columns)
            ->execute()
            ->all();

        return $data;
    }

    /**
     * Get records by specified filters.
     *
     * @return object[]
     */
    protected function getAllBy(): array
    {
        $data = DB::table($this->table)
            ->select($this->columns)
            ->addStatementWithValues(
                $this->convertFiltersToStatement(),
                $this->filterValues
            )
            ->execute()
            ->all();

        $this->reset();

        return $data;
    }

    /**
     * Create a new record.
     *
     * @return void|bool
     */
    protected function create()
    {
        DB::table($this->table)
            ->insert($this->fields)
            ->execute();
    }

    /**
     * Save existing date in the database.
     *
     * @return void|bool
     */
    protected function save()
    {
        DB::table($this->table)
            ->update($this->fields)
            ->addStatementWithValues(
                $this->convertFiltersToStatement(),
                $this->filterValues
            )
            ->execute();
    }

    /**
     * @return void|bool
     */
    protected function delete()
    {
        DB::table($this->table)
            ->delete($this->softDeleteColumn)
            ->addStatementWithValues(
                $this->convertFiltersToStatement(),
                $this->filterValues
            )
            ->execute();
    }

    /**
     * Set the columns to be selected.
     *
     * @param string[] ...$columns the columns to be selected.
     */
    final protected function setColumns(...$columns): void
    {
        $this->columns = implode(', ', $columns);
    }

    /**
     * Set the fields who are going to be updated or inserted.
     *
     * @param string[] $fields
     */
    final protected function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    /**
     * Specify (multiple) filter(s) for the get and get all by methods.
     *
     * @param string $column    the column to be filtered
     * @param string $operator  the column to be filtered
     * @param string $value     the value of the filter
     */
    final protected function setFilter(
        string $column,
        string $operator,
        string $value
    ): void {
        $this->filters[$column] = [
            'operator' => $operator,
            'condition' => $value
        ];
    }

    /**
     * Convert the filters into a statement.
     *
     * @return string
     */
    private function convertFiltersToStatement(): string
    {
        $statement = '';
        $this->filterValues = [];

        foreach ($this->filters as $column => $filter) {
            $operator = $filter['operator'] ?? '';
            $condition = $filter['condition'] ?? '';

            $statement .= "WHERE {$column} {$operator} :{$column} ";
            $this->filterValues += [$column => $condition];
        }

        return $statement;
    }

    final public function reset(): void
    {
        $this->filters = [];
        $this->filterValues = [];
    }
}
