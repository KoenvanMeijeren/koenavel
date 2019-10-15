<?php

declare(strict_types=1);

namespace App\Services\Validate;

final class Validate
{
    use BasicValidation;
    use FileValidation;
    use ObjectValidation;
    use UriValidation;

    /**
     * The var to be validated.
     *
     * @var mixed
     */
    private static $var;

    /**
     * Store the variable to.
     *
     * @param mixed $var the var to be validated
     *
     * @return Validate
     */
    public static function var($var): Validate
    {
        self::$var = $var;

        return new static();
    }
}
