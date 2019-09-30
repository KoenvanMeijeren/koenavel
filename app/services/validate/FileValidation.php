<?php
declare(strict_types=1);


namespace App\services\validate;

use Exception;

trait FileValidation
{
    /**
     * Check if the file exists.
     *
     * @return Validate
     *
     * @throws Exception
     */
    public function fileExists()
    {
        if (!file_exists(self::$var)) {
            throw new Exception(
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
     * @throws Exception
     */
    public function isResource()
    {
        if (!is_resource(self::$var)) {
            throw new Exception(
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
     * @throws Exception
     */
    public function isReadable()
    {
        if (!is_readable(self::$var)) {
            throw new Exception(
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
     * @throws Exception
     */
    public function isWritable()
    {
        if (!is_writable(self::$var)) {
            throw new Exception(
                'The file must be writable: ' . self::$var
            );
        }

        return new Validate();
    }
}
