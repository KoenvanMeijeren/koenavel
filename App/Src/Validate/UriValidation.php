<?php
declare(strict_types=1);

namespace App\Src\Validate;

use App\Src\Core\Env;
use App\Src\Exceptions\Uri\InvalidDomainException;
use App\Src\Exceptions\Uri\InvalidEnvException;
use App\Src\Exceptions\Uri\InvalidUriException;
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
        if (filter_var(self::$var, FILTER_VALIDATE_URL) === false) {
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
        if (self::$var !== 'localhost'
            && preg_match(
                '/[a-zA-Z]{0,9}+[:][0-9]{0,4}/',
                self::$var
            ) === 0
            && preg_match(
                '/(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/',
                self::$var
            ) === 0
        ) {
            throw new InvalidDomainException(
                'Invalid domain: '.self::$var.' given.'
            );
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
