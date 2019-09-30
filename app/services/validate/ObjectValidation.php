<?php

namespace App\services\validate;

use Exception;

trait ObjectValidation
{
    /**
     * Check the variable if it is an object.
     *
     * @return Validate
     *
     * @throws Exception
     */
    public function isObject()
    {
        if (!is_object(self::$var)) {
            throw new Exception(
                gettype(self::$var) . ' given. The variable must be an object.'
            );
        }

        return new Validate();
    }

    /**
     * Check if the method exists in the object.
     *
     * @param string $methodName the method to check
     *
     * @return Validate
     *
     * @throws Exception
     */
    public function methodExists(string $methodName)
    {
        if (!method_exists(self::$var, $methodName)) {
            throw new Exception(
                "The called method {$methodName} does not exist in the object " . serialize(self::$var) . '.'
            );
        }

        return new Validate();
    }

    /**
     * Check if a function is callable.
     *
     * @param string $syntax_only determine if it must be syntax only
     * @param string $callable_name the name to be called
     *
     * @return Validate
     *
     * @throws Exception
     */
    public function isCallable(
        string $syntax_only = null, $callable_name = null
    ) {
        if (!is_callable(self::$var)) {
            throw new Exception(
                "The called method does not exist: " .
                serialize(self::$var) . '.'
            );
        }

        return new Validate();
    }
}
