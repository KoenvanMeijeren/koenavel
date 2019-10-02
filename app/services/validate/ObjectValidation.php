<?php

namespace App\services\validate;

use App\services\exceptions\object\InvalidMethodCalledException;
use App\services\exceptions\object\InvalidObjectException;
use App\services\exceptions\object\MethodNotCallableException;

trait ObjectValidation
{
    /**
     * Check the variable if it is an object.
     *
     * @return Validate
     *
     * @throws InvalidObjectException
     */
    public function isObject(): Validate
    {
        if (!is_object(self::$var)) {
            throw new InvalidObjectException(
                gettype(self::$var) .
                ' given. The variable must be an object.'
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
     * @throws InvalidMethodCalledException
     */
    public function methodExists(string $methodName): Validate
    {
        if (!method_exists(self::$var, $methodName)) {
            throw new InvalidMethodCalledException(
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
     * @throws MethodNotCallableException
     */
    public function isCallable(
        string $syntax_only = null,
        string $callable_name = null
    ): Validate {
        if (!is_callable(self::$var, $syntax_only, $callable_name)) {
            throw new MethodNotCallableException(
                "The called method does not exist: " .
                serialize(self::$var) . '.'
            );
        }

        return new Validate();
    }
}
