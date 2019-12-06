<?php
declare(strict_types=1);

namespace App\Src\Validate;

use App\Src\Exceptions\Object\InvalidMethodCalledException;
use App\Src\Exceptions\Object\InvalidObjectException;
use App\Src\Exceptions\Object\MethodNotCallableException;

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
     * @return Validate
     * @throws MethodNotCallableException
     */
    public function isCallable(): Validate
    {
        if (!is_callable(self::$var)) {
            throw new MethodNotCallableException(
                'The called method does not exist: ' .
                serialize(self::$var) . '.'
            );
        }

        return new Validate();
    }
}
