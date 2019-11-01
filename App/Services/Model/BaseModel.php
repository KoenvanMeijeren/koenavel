<?php
declare(strict_types=1);


namespace App\Services\Model;

use App\Services\Database\DB;
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
     * The id of a record.
     *
     * @var string
     */
    protected $id = '0';

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
     * Construct the model.
     */
    abstract public function __construct();

    /**
     * Get data from the specified table.
     *
     * @return stdClass
     */
    public function get(): stdClass
    {
        $data = DB::table($this->table)
            ->select($this->columns)
            ->where($this->idColumn, '=', $this->id)
            ->execute()
            ->first();

        return $data;
    }

    /**
     * Get a record by a specified filter.
     *
     * @param string $operator the operator
     *
     * @return stdClass
     */
    public function getBy(string $operator = '='): stdClass
    {
        $data = DB::table($this->table)
            ->select($this->columns)
            ->addStatementWithValues(
                $this->convertFiltersToStatement(), $this->filterValues
            )
            ->execute()
            ->first();

        return $data;
    }

    /**
     * Get all records from the table.
     *
     * @return object[]
     */
    public function getAll(): array
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
    public function getAllBy(): array
    {
        $data = DB::table($this->table)
            ->select($this->columns)
            ->addStatementWithValues(
                $this->convertFiltersToStatement(), $this->filterValues
            )
            ->execute()
            ->all();

        return $data;
    }

    /**
     * Set the columns to be selected.
     *
     * @param string[] ...$columns the columns to be selected.
     */
    protected function setColumns(...$columns): void
    {
        $this->columns = implode(', ', $columns);
    }

    /**
     * Specify (multiple) filter(s) for the get and get all by methods.
     *
     * @param string $column    the column to be filtered
     * @param string $operator  the column to be filtered
     * @param string $value     the value of the filter
     */
    protected function setFilters(
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
        foreach ($this->filters as $column => $filter) {
            $operator = $filter['operator'] ?? '';
            $condition = $filter['condition'] ?? '';

            $statement .= "WHERE {$column} {$operator} :{$column} ";
            $this->filterValues += [$column => $condition];
        }

        return $statement;
    }
}
