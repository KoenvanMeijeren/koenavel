<?php

namespace App\services\validate;

use App\services\core\Env;
use Exception;

trait UriValidation
{
    /**
     * Check the variable if it is an url.
     *
     * @return Validate
     *
     * @throws Exception
     */
    public function isUrl()
    {
        if (!filter_var(self::$var, FILTER_VALIDATE_URL)) {
            throw new Exception('Invalid url given.');
        }

        return new Validate();
    }

    /**
     * Check if the variable is a domain.
     *
     * @return Validate
     *
     * @throws Exception
     */
    public function isDomain()
    {
        if (!strstr(self::$var, 'localhost') && !strstr(self::$var,
                '127.0.0.1')
            && !preg_match('^(?!-)(?:[a-zA-Z\\d\\-]{0,62}[a-zA-Z\\d]\\.){1,126}(?!\\d+)[a-zA-Z\\d]{1,63}$^',
                self::$var)
        ) {
            throw new Exception('Invalid domain given.');
        }

        return new Validate();
    }

    /**
     * Check if the variable is an env.
     *
     * @return Validate
     *
     * @throws Exception
     */
    public function isEnv()
    {
        if (Env::DEVELOPMENT !== self::$var && Env::PRODUCTION !== self::$var) {
            throw new Exception('Invalid environment given.');
        }

        return new Validate();
    }
}
