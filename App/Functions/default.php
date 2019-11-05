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

if (!function_exists('replaceString')) {
    /**
     * Replace all found strings in a string.
     *
     * @param string $toRemove  the string to be replaced
     * @param string $toReplace the new value of the string
     *                          which is going to be replaced
     * @param string $string    the string to search in
     * @param int    $limit     limit the number of matches
     *
     * @return string
     */
    function replaceString(
        string $toRemove,
        string $toReplace,
        string $string,
        int $limit = -1
    ) {
        return (string) preg_replace(
            '/\b('.$toRemove.')\b/',
            $toReplace,
            $string,
            $limit
        );
    }
}

if (!function_exists('replaceAllExceptFirstString')) {
    /**
     * Replace all found strings in a string.
     *
     * @param string $toRemove  the string to be replaced
     * @param string $toReplace the new value of the string
     *                          which is going to be replaced
     * @param string $string    the string to search in
     *
     * @return string
     */
    function replaceAllExceptFirstString(
        string $toRemove,
        string $toReplace,
        string $string
    ) {
        return (string) replaceString(
            $toReplace,
            $toRemove,
            replaceString(
                $toRemove,
                $toReplace,
                $string
            ),
            1
        );
    }
}
