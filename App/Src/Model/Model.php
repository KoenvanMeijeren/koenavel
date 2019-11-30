<?php
declare(strict_types=1);


namespace App\Src\Model;


use App\Src\Database\DB;
use stdClass;

abstract class Model
{
    protected string $table;
    protected string $primaryKey;

    /**
     * Create a new record.
     *
     * @param string[] $attributes
     */
    public function create(array $attributes)
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
    public function updateOrCreate(int $id, array $attributes)
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
    public function update(int $id, array $attributes)
    {
        DB::table($this->table)
            ->update($attributes)
            ->where($this->primaryKey, '=', (string) $id)
            ->execute();
    }

    /**
     * Get the first record for the given attributes.
     *
     * @param string[] $attributes
     *
     * @return stdClass
     */
    protected function firstByAttributes(array $attributes)
    {
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
     * @return stdClass
     */
    protected function firstByID(int $id)
    {
        return DB::table($this->table)
            ->select('*')
            ->where($this->primaryKey, '=', (string) $id)
            ->first();
    }

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
