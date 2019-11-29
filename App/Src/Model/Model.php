<?php
declare(strict_types=1);


namespace App\Src\Model;


use App\Src\Database\DB;

abstract class Model
{
    protected string $table;
    protected string $primaryKey = 'id';

    protected array $attributes = [];

    public function create(array $attributes)
    {
        DB::table($this->table)
            ->insert($attributes)
            ->execute();
    }

    /**
     * Get all of the current attributes on the model.
     *
     * @param string $key
     * @return mixed|void
     */
    public function getAttribute(string $key)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }
    }

    /**
     * Set a given attribute on the model.
     *
     * @param string $key
     * @param mixed  $value
     */
    public function setAttribute(string $key, $value): void {
        $this->attributes[$key] = $value;
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }
    /**
     * Dynamically set attributes on the model.
     *
     * @param  string  $key
     * @param  mixed   $value
     */
    public function __set($key, $value): void
    {
        $this->setAttribute($key, $value);
    }
}
