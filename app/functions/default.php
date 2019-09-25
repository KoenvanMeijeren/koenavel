<?php

declare(strict_types=1);

if (!function_exists('dd')) {
    /**
     * Var dump the variable and die the script.
     *
     * @param mixed ...$expression The expression to debug.
     */
    function dd(...$expression)
    {
        foreach ($expression as $item) {
            echo '<pre>';
            var_dump($item);
        }

        die;
    }
}

if (!function_exists('array_key_last')) {
    /**
     * Polyfill for array_key_last() function added in PHP 7.3.
     *
     * Get the last key of the given array without affecting
     * the internal array pointer.
     *
     * @param array $array An array
     *
     * @return null|int|string the last key of array if the array is not empty; NULL otherwise
     */
    function array_key_last(array $array)
    {
        end($array);

        return key($array);
    }
}

if (!function_exists('array_replace_keys')) {
    /**
     * This function replaces the keys of an associate array by those supplied in the keys array.
     *
     * @param array $array target associative array in which the keys are intended to be replaced
     * @param array $keys  associate array where search key => replace by key, for replacing respective keys
     *
     * @return array with replaced keys
     */
    function array_replace_keys(array $array, array $keys)
    {
        foreach ($keys as $search => $replace) {
            if (isset($array[$search])) {
                $array[$replace] = $array[$search];
                unset($array[$search]);
            }
        }

        return $array;
    }
}

if (!function_exists('parseHTMLEntities')) {
    /**
     * Parse the data into HTML entities.
     *
     * @param string $data the data to be parsed
     *
     * @return string
     */
    function parseHTMLEntities(string $data)
    {
        return html_entity_decode(htmlspecialchars_decode($data));
    }
}
