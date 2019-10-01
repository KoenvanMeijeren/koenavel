<?php

namespace App\services\validate;

use App\services\exceptions\basic\EmptyVarException;
use App\services\exceptions\basic\InvalidTypeException;

trait BasicValidation
{
    /**
     * Check the variable if it is not empty.
     *
     * @return Validate
     *
     * @throws EmptyVarException
     */
    public function isNotEmpty(): Validate
    {
        if ((int)(0 !== self::$var) && empty(self::$var)) {
            throw new EmptyVarException(
                'Empty variable given. The variable cannot be empty.'
            );
        }

        return new Validate();
    }

    /**
     * Check the variable if it is a scalar type.
     *
     * @return Validate
     *
     * @throws InvalidTypeException
     */
    public function isScalar(): Validate
    {
        if (!is_scalar(self::$var)) {
            throw new InvalidTypeException(
                gettype(self::$var) . ' given. The variable must be a scalar type.'
            );
        }

        return new Validate();
    }

    /**
     * Check the variable if it is a string.
     *
     * @return Validate
     *
     * @throws InvalidTypeException
     */
    public function isString(): Validate
    {
        if (!is_string(self::$var)) {
            throw new InvalidTypeException(
                gettype(self::$var) . ' given. The variable must be a string.'
            );
        }

        return new Validate();
    }

    /**
     * Check the variable if it is an int.
     *
     * @return Validate
     *
     * @throws InvalidTypeException
     */
    public function isInt(): Validate
    {
        if (!is_int(self::$var)) {
            throw new InvalidTypeException(
                gettype(self::$var) . ' given. The variable must be an int.'
            );
        }

        return new Validate();
    }

    /**
     * Check the variable if it is an int.
     *
     * @return Validate
     *
     * @throws InvalidTypeException
     */
    public function isFloat(): Validate
    {
        if (!is_float(self::$var)) {
            throw new InvalidTypeException(
                gettype(self::$var) . ' given. The variable must be a float.'
            );
        }

        return new Validate();
    }

    /**
     * Check the variable if it is numeric.
     *
     * @return Validate
     *
     * @throws InvalidTypeException
     */
    public function isNumeric(): Validate
    {
        if (!is_numeric(self::$var)) {
            throw new InvalidTypeException(
                gettype(self::$var) . ' given. The variable must be numeric.'
            );
        }

        return new Validate();
    }

    /**
     * Check the variable if it is countable.
     *
     * @return Validate
     *
     * @throws InvalidTypeException
     */
    public function isCountable(): Validate
    {
        if (!is_countable(self::$var)) {
            throw new InvalidTypeException(
                gettype(self::$var) . ' given. The variable must be countable.'
            );
        }

        return new Validate();
    }

    /**
     * Check the variable if it is an array.
     *
     * @return Validate
     *
     * @throws InvalidTypeException
     */
    public function isArray(): Validate
    {
        if (!is_array(self::$var)) {
            throw new InvalidTypeException(
                gettype(self::$var) . ' given. The variable must be an array.'
            );
        }

        return new Validate();
    }
}
