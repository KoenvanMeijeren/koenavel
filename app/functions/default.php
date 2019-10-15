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
