<?php

declare(strict_types=1);

use App\Services\Exceptions\File\FileNotExistingException;
use App\Services\Validate\Validate;

/**
 * Load a file and return it.
 *
 * @param string  $filename the filename
 * @param mixed[] $vars     the vars to use in the loaded file file
 *
 * @return string
 *
 * @throws FileNotExistingException
 */
function loadFile(string $filename, $vars = null)
{
    if (!empty($vars)) {
        extract($vars);
    }
    Validate::var($filename)->fileExists();

    return include $filename;
}

/**
 * Load a picture and return it.
 *
 * @param string $name     the filename
 * @param string $fallback the fallback for the filename
 *
 * @return string the image or a fallback otherwise nothing
 */
function loadImage(string $name, string $fallback)
{
    if (!empty($name)
        && file_exists($_SERVER['DOCUMENT_ROOT'].$name)
    ) {
        return $name;
    }

    if (!empty($fallback)
        && file_exists($_SERVER['DOCUMENT_ROOT'].$fallback)
    ) {
        return $fallback;
    }

    return '';
}

/**
 * Load a table and return it.
 *
 * @param string $filename the filename
 * @param array  $keys     the keys to use in the loaded table
 * @param array  $rows     the rows to use in the loaded table
 *
 * @return string
 *
 * @throws FileNotExistingException
 */
function loadTable(string $filename, array $keys, array $rows = [])
{
    $filename = RESOURCES_PATH."/partials/tables/{$filename}.view.php";
    Validate::var($filename)->fileExists();

    return include_once $filename;
}
