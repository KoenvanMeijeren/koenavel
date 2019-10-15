<?php
declare(strict_types=1);


namespace App\Services\Validate;

use App\Services\Exceptions\File\FileNotExistingException;
use App\Services\Exceptions\File\FileNotOfResourceTypeException;
use App\Services\Exceptions\File\FileNotReadableException;
use App\Services\Exceptions\File\FileNotWritableException;

trait FileValidation
{
    /**
     * Check if the file exists.
     *
     * @return Validate
     *
     * @throws FileNotExistingException
     */
    public function fileExists(): Validate
    {
        if (!file_exists(self::$var)) {
            throw new FileNotExistingException(
                'Could not load the given file ' . self::$var
            );
        }

        return new Validate();
    }

    /**
     * Check if the file is a resource.
     *
     * @return Validate
     *
     * @throws FileNotOfResourceTypeException
     */
    public function isResource(): Validate
    {
        if (!is_resource(self::$var)) {
            throw new FileNotOfResourceTypeException(
                'The file must be a resource: ' . self::$var
            );
        }

        return new Validate();
    }

    /**
     * Check if the file is readable.
     *
     * @return Validate
     *
     * @throws FileNotReadableException
     */
    public function isReadable(): Validate
    {
        if (!is_readable(self::$var)) {
            throw new FileNotReadableException(
                'The file must be readable: ' . self::$var
            );
        }

        return new Validate();
    }

    /**
     * Check if the file is writable.
     *
     * @return Validate
     *
     * @throws FileNotWritableException
     */
    public function isWritable(): Validate
    {
        if (!is_writable(self::$var)) {
            throw new FileNotWritableException(
                'The file must be writable: ' . self::$var
            );
        }

        return new Validate();
    }
}
