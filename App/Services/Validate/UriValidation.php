<?php

namespace App\Services\Validate;

use App\Services\Core\Env;
use App\Services\Exceptions\Uri\InvalidDomainException;
use App\Services\Exceptions\Uri\InvalidEnvException;
use App\Services\Exceptions\Uri\InvalidUriException;
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
    public function isUrl(): Validate
    {
        if (!filter_var(self::$var, FILTER_VALIDATE_URL)) {
            throw new InvalidUriException('Invalid url given.');
        }

        return new Validate();
    }

    /**
     * Check if the variable is a domain.
     *
     * @return Validate
     *
     * @throws InvalidDomainException
     */
    public function isDomain(): Validate
    {
        if (!strstr(self::$var, 'localhost')
            && !strstr(self::$var, '127.0.0.1')
            && !preg_match('^(?!-)(?:[a-zA-Z\\d\\-]{0,62}[a-zA-Z\\d]\\.){1,126}(?!\\d+)[a-zA-Z\\d]{1,63}$^', self::$var)
        ) {
            throw new InvalidDomainException('Invalid domain given.');
        }

        return new Validate();
    }

    /**
     * Check if the variable is of the type of an env.
     *
     * @return Validate
     *
     * @throws InvalidEnvException
     */
    public function isEnv(): Validate
    {
        if (Env::DEVELOPMENT !== self::$var
            && Env::PRODUCTION !== self::$var
        ) {
            throw new InvalidEnvException('Invalid environment given.');
        }

        return new Validate();
    }
}
