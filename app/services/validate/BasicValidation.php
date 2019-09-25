<?php

namespace App\services\validate;

use Exception;

trait BasicValidation
{
    /**
     * Check the variable if it is not empty.
     *
     * @return Validate
     *
     * @throws Exception
     */
    public function isNotEmpty()
    {
        if ((int)(0 !== self::$var) && empty(self::$var)) {
            throw new Exception(
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
     * @throws Exception
     */
    public function isScalar()
    {
        if (!is_scalar(self::$var)) {
            throw new Exception(
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
     * @throws Exception
     */
    public function isString()
    {
        if (!is_string(self::$var)) {
            throw new Exception(
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
     * @throws Exception
     */
    public function isInt()
    {
        if (!is_int(self::$var)) {
            throw new Exception(
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
     * @throws Exception
     */
    public function isFloat()
    {
        if (!is_float(self::$var)) {
            throw new Exception(
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
     * @throws Exception
     */
    public function isNumeric()
    {
        if (!is_numeric(self::$var)) {
            throw new Exception(
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
     * @throws Exception
     */
    public function isCountable()
    {
        if (!is_countable(self::$var)) {
            throw new Exception(
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
     * @throws Exception
     */
    public function isArray()
    {
        if (!is_array(self::$var)) {
            throw new Exception(
                gettype(self::$var) . ' given. The variable must be an array.'
            );
        }

        return new Validate();
    }
}
