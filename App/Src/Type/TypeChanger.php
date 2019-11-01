<?php
declare(strict_types=1);


namespace App\Src\Type;

use App\Src\Core\Sanitize;

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
     */
    public function toString(): string
    {
        if (is_scalar($this->var)) {
            $sanitize = new Sanitize($this->var);
            return (string)$sanitize->data();
        }

        return (string)'';
    }

    /**
     * Convert a variable to int.
     *
     * @return int
     */
    public function toInt(): int
    {
        if (is_scalar($this->var)) {
            $sanitize = new Sanitize($this->var);
            return (int)$sanitize->data();
        }

        return 0;
    }

    /**
     * Convert a variable to float.
     *
     * @return float
     */
    public function toFloat(): float
    {
        if (is_scalar($this->var)) {
            $sanitize = new Sanitize($this->var);
            return (float)$sanitize->data();
        }

        return 0.0;
    }

    /**
     * Convert a variable to an array.
     *
     * @return mixed[]
     */
    public function toArray(): array
    {
        if (is_array($this->var)) {
            return (array)$this->var;
        }

        if (is_string($this->var)) {
            $possibleArray = json_decode(
                $this->var,
                false,
                512,
                JSON_THROW_ON_ERROR
            );
            if (is_array($possibleArray)) {
                return $possibleArray;
            }
        }

        return [];
    }

    /**
     * Convert a variable to json
     *
     * @return string
     */
    public function toJson(): string
    {
        return (string)json_encode($this->var, JSON_THROW_ON_ERROR);
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
