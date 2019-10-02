<?php
declare(strict_types=1);


namespace App\services\type;


use App\services\core\Sanitize;
use App\services\exceptions\basic\InvalidTypeException;

class TypeChanger
{
    /**
     * Change the type of the var.
     *
     * @var mixed
     */
    private $var;

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
     * @return array
     * @throws InvalidTypeException
     */
    public function toArray(): array
    {
        if (is_array($this->var)) {
            return (array)$this->var;
        }

        if (is_string($this->var)) {
            $possibleArray = json_decode($this->var);
            if (is_array($possibleArray)) {
                return $possibleArray;
            }
        }

        throw new InvalidTypeException(
            "Cannot convert the variable to an array."
        );
    }
}
