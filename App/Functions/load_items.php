<?php

declare(strict_types=1);

use App\Src\Exceptions\File\FileNotFoundException;
use App\Src\Validate\Validate;

function includeFile(string $filename, $vars = null)
{
    if (!empty($vars)) {
        extract($vars, EXTR_SKIP);
    }
    Validate::var($filename)->fileExists();

    return include $filename;
}

function getFileContent(string $filename)
{
    Validate::var($filename)->fileExists();

    return file_get_contents($filename);
}

/**
 * Load a picture and return it.
 *
 * @param string $name     the filename
 * @param string $fallback the fallback for the filename
 *
 * @return string the image or a fallback otherwise nothing
 */
function includeImage(string $name, string $fallback)
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
 * @throws FileNotFoundException
 */
function loadTable(string $filename, array $keys, array $rows = [])
{
    $filename = RESOURCES_PATH."/partials/tables/{$filename}.view.php";
    Validate::var($filename)->fileExists();

    return include $filename;
}
