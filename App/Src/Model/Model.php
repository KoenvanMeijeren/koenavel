<?php
declare(strict_types=1);


namespace App\Src\Model;

use App\Src\Database\DB;
use stdClass;

/**
 * Class Model
 * @package App\Src\Model
 *
 * @todo find out how i can add dynamic scopes and statements
 * @todo find out how i can define relations between classes and automatic select both records
 */
abstract class Model
{
    protected string $table;
    protected string $primaryKey;
    protected bool $softDelete = true;
    protected string $softDeletedKey;

    /**
     * Create a new record.
     *
     * @param string[] $attributes
     */
    public function create(array $attributes): void
    {
        DB::table($this->table)
            ->insert($attributes);
    }

    /**
     * Get the first record matching the attributes or create it.
     *
     * @param string[] $attributes
     *
     * @return stdClass|void
     */
    public function firstOrCreate(array $attributes)
    {
        $result = $this->firstByAttributes($attributes);
        if ($result !== false) {
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
    public function updateOrCreate(int $id, array $attributes): void
    {
        if ($this->firstByID($id) === false) {
            $this->create($attributes);
            return;
        }

        $this->update($id, $attributes);
        return;
    }

    /**
     * Update a record.
     *
     * @param int      $id
     * @param string[] $attributes
     */
    public function update(int $id, array $attributes): void
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
     * @return false|object[]
     */
    public function all(array $columns = array('*'))
    {
        $columns = implode(',', $columns);

        if ($this->softDelete) {
            return DB::table($this->table)
                ->select($columns)
                ->where($this->softDeletedKey, '=', '0')
                ->get();
        }

        return DB::table($this->table)->select($columns)->get();
    }

    /**
     * Get the first record for the given id.
     *
     * @param int      $id
     * @param string[] $columns
     *
     * @return false|stdClass
     */
    public function find(int $id, array $columns = array('*'))
    {
        $columns = implode(',', $columns);

        if ($this->softDelete) {
            return DB::table($this->table)
                ->select($columns)
                ->where($this->primaryKey, '=', (string) $id)
                ->where($this->softDeletedKey, '=', '0')
                ->first();
        }

        return DB::table($this->table)
            ->select($columns)
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
    public function delete(int $id)
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
     * @return stdClass|false
     */
    protected function firstByAttributes(array $attributes)
    {
        if ($this->softDelete) {
            return DB::table($this->table)
                ->select('*')
                ->where($this->softDeletedKey, '=', '0')
                ->addStatementWithValues(
                    $this->convertAttributesIntoWhereQuery($attributes),
                    $this->convertAttributesIntoWhereValues($attributes)
                )->first();
        }

        return DB::table($this->table)
            ->select('*')
            ->addStatementWithValues(
                $this->convertAttributesIntoWhereQuery($attributes),
                $this->convertAttributesIntoWhereValues($attributes)
            )->first();
    }

    /**
     * Get the first record for the given id.
     *
     * @param int $id
     *
     * @return stdClass|false
     */
    protected function firstByID(int $id)
    {
        if ($this->softDelete) {
            return DB::table($this->table)
                ->select('*')
                ->where($this->primaryKey, '=', (string) $id)
                ->where($this->softDeletedKey, '=', '0')
                ->first();
        }

        return DB::table($this->table)
            ->select('*')
            ->where($this->primaryKey, '=', (string) $id)
            ->first();
    }

    /**
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
     * Covert the given attributes into values.
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
