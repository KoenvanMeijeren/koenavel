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
    public function toString()
    {
        if (is_scalar($this->var)) {
            $sanitize = new Sanitize($this->var);
            return (string) $sanitize->data();
        }

        throw new InvalidTypeException(
            "Cannot convert a non scalar variable to string."
        );
    }

    /**
     * Convert a variable to an array.
     *
     * @return array
     * @throws InvalidTypeException
     */
    public function toArray()
    {
        if (is_array($this->var)) {
            return (array) $this->var;
        }

        throw new InvalidTypeException(
            "Cannot convert a scalar variable to array."
        );
    }
}
