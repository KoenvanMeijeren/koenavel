<?php
declare(strict_types=1);


namespace App\Services\Type;

use App\Services\Core\Sanitize;
use App\Services\Exceptions\Basic\InvalidTypeException;

class TypeChanger
{
    /**
     * Change the type of the var.
     *
     * @var mixed
     */
    private $var;

    /**
     * @param mixed $var The var to change the type of
     */
    public function __construct($var)
    {
        $this->var = $var;
    }

    /**
     * Convert a variable to string.
     *
     * @return string
     * @throws InvalidTypeException
     */
    public function toString(): string
    {
        if (is_scalar($this->var)) {
            $sanitize = new Sanitize($this->var);
            return (string)$sanitize->data();
        }

        throw new InvalidTypeException(
            "Cannot convert a non scalar variable to string."
        );
    }

    /**
     * Convert a variable to int.
     *
     * @return int
     * @throws InvalidTypeException
     */
    public function toInt(): int
    {
        if (is_scalar($this->var)) {
            $sanitize = new Sanitize($this->var);
            return (int)$sanitize->data();
        }

        throw new InvalidTypeException(
            "Cannot convert a non scalar variable to int."
        );
    }

    /**
     * Convert a variable to float.
     *
     * @return float
     * @throws InvalidTypeException
     */
    public function toFloat(): float
    {
        if (is_scalar($this->var)) {
            $sanitize = new Sanitize($this->var);
            return (float)$sanitize->data();
        }

        throw new InvalidTypeException(
            "Cannot convert a non scalar variable to float."
        );
    }

    /**
     * Convert a variable to an array.
     *
     * @return mixed[]
     * @throws InvalidTypeException
     */
    public function toArray(): array
    {
        if (is_array($this->var)) {
            return (array)$this->var;
        }

        if (is_string($this->var)) {
            $possibleArray = json_decode($this->var, false, 512, JSON_THROW_ON_ERROR);
            if (is_array($possibleArray)) {
                return $possibleArray;
            }
        }

        throw new InvalidTypeException(
            "Cannot convert the variable to an array."
        );
    }

    /**
     * Convert a variable to json
     *
     * @return string
     * @throws InvalidTypeException
     */
    public function toJson(): string
    {
        if (is_scalar($this->var)) {
            return (string) json_encode($this->var, JSON_THROW_ON_ERROR);
        }

        throw new InvalidTypeException(
            "Cannot convert the variable to json"
        );
    }

    /**
     * Decode a json string and return the type changer.
     *
     * @return TypeChanger
     */
    public function decodeJson(): TypeChanger
    {
        $var = json_decode($this->var, false, 512, JSON_THROW_ON_ERROR);

        return new TypeChanger($var);
    }
}