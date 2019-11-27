<?php
declare(strict_types=1);


namespace App\Src\Model;

use App\Src\Database\DB;
use stdClass;

abstract class BaseModel
{
    /**
     * The table to select records from.
     *
     * @var string
     */
    protected $table = '';

    /**
     * The columns to be selected.
     *
     * @var string
     */
    protected $columns = '*';

    /**
     * Set the column name of the ids.
     *
     * @var string
     */
    protected $idColumn = 'ID';

    /**
     * @var string
     */
    protected $softDeleteColumn = '';

    /**
     * The id of a record.
     *
     * @var int
     */
    protected $id = 0;

    /**
     * The filter of the get and get all by method.
     *
     * @var array
     */
    private $filters = [];

    /**
     * The values of the specified filters.
     *
     * @var string[]
     */
    private $filterValues = [];

    /**
     * The fields to be inserted or updated.
     *
     * @var string[]
     */
    private $fields = [];

    /**
     * Get data from the specified table.
     *
     * @return stdClass
     */
    protected function get()
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
    protected function getBy()
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
    protected function getAll()
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
    protected function getAllBy()
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
     */
    protected function create()
    {
        DB::table($this->table)
            ->insert($this->fields)
            ->execute();
    }

    /**
     * Save existing date in the database.
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

    public function reset(): void
    {
        $this->filters = [];
        $this->filterValues = [];
    }
}
