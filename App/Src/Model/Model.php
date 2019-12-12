<?php
declare(strict_types=1);


namespace App\Src\Model;

use App\Src\Database\DB;
use stdClass;

abstract class Model
{
    protected string $table;
    protected string $primaryKey;
    protected string $softDeletedKey;

    protected array $scopes = [
        'query' => '',
        'values' => [],
    ];

    /**
     * Create a new record.
     *
     * @param string[] $attributes
     */
    final public function create(array $attributes): void
    {
        DB::table($this->table)
            ->insert($attributes);
    }

    /**
     * Get the first record matching the attributes or create it.
     *
     * @param string[] $attributes
     *
     * @return stdClass
     */
    final public function firstOrCreate(array $attributes): stdClass
    {
        if (($result = $this->firstByAttributes($attributes)) !== null) {
            return $result;
        }

        $this->create($attributes);

        return $this->firstOrCreate($attributes);
    }

    /**
     * Create or update a record.
     *
     * @param int      $id
     * @param string[] $attributes
     */
    final public function updateOrCreate(int $id, array $attributes): void
    {
        if ($this->firstByID($id) === null) {
            $this->create($attributes);
            return;
        }

        $this->update($id, $attributes);
    }

    /**
     * Update a record.
     *
     * @param int      $id
     * @param string[] $attributes
     */
    final public function update(int $id, array $attributes): void
    {
        DB::table($this->table)
            ->update($attributes)
            ->where($this->primaryKey, '=', (string) $id)
            ->execute();
    }

    /**
     * Get all records.
     *
     * @param string[] $columns
     *
     * @return object[]
     */
    final public function all(array $columns = array('*')): array
    {
        return (array) DB::table($this->table)
            ->select(implode(',', $columns))
            ->addStatementWithValues(
                $this->scopes['query'],
                $this->scopes['values']
            )
            ->get();
    }

    /**
     * Get the first record for the given id.
     *
     * @param int      $id
     * @param string[] $columns
     *
     * @return stdClass|null
     */
    final public function find(int $id, array $columns = array('*')): ?stdClass
    {
        return DB::table($this->table)
            ->select(implode(',', $columns))
            ->addStatementWithValues(
                $this->scopes['query'],
                $this->scopes['values']
            )
            ->where($this->primaryKey, '=', (string) $id)
            ->first();
    }

    /**
     * Delete a record by the given id..
     *
     * @param int $id
     *
     * @return mixed|void
     */
    final public function delete(int $id)
    {
        DB::table($this->table)
            ->delete($this->softDeletedKey)
            ->where($this->primaryKey, '=', (string) $id)
            ->execute();
    }

    /**
     * Get the first record for the given attributes.
     *
     * @param string[] $attributes
     *
     * @return stdClass|null
     */
    final protected function firstByAttributes(array $attributes): ?stdClass
    {
        return DB::table($this->table)
            ->select('*')
            ->addStatementWithValues(
                $this->scopes['query'],
                $this->scopes['values']
            )->addStatementWithValues(
                $this->convertAttributesIntoWhereQuery($attributes),
                $this->convertAttributesIntoWhereValues($attributes)
            )->first();
    }

    /**
     * Get the first record for the given id.
     *
     * @param int $id
     *
     * @return stdClass|null
     */
    final protected function firstByID(int $id): ?stdClass
    {
        return DB::table($this->table)
            ->select('*')
            ->addStatementWithValues(
                $this->scopes['query'],
                $this->scopes['values']
            )
            ->where($this->primaryKey, '=', (string) $id)
            ->first();
    }

    final protected function addScope(DB $builder): void
    {
        $this->scopes['query'] .= $builder->getQuery();
        $this->scopes['values'] += $builder->getValues();
    }

    /**
     * Convert the given attributes into a query.
     *
     * @param string[] $attributes
     *
     * @return string
     */
    private function convertAttributesIntoWhereQuery(
        array $attributes
    ): string {
        $query = '';
        foreach ($attributes as $column => $attribute) {
            $query .= DB::table($this->table)
                ->where($column, '=', $attribute)
                ->getQuery();
        }
        return $query;
    }
    /**
     * Convert the given attributes into values.
     *
     * @param string[] $attributes
     *
     * @return string[]
     */
    private function convertAttributesIntoWhereValues(
        array $attributes
    ): array {
        $values = [];
        foreach ($attributes as $column => $attribute) {
            $values += DB::table($this->table)
                ->where($column, '=', $attribute)
                ->getValues();
        }

        return $values;
    }
}
