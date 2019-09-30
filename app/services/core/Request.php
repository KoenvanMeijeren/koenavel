<?php
declare(strict_types=1);


namespace App\services\core;

final class Request
{
    /**
     * Get a post item.
     *
     * @param string $key the key to search for the corresponding value in the post array
     *
     * @return string
     */
    public function post(string $key)
    {
        if (!isset($_POST[$key])) {
            return '';
        }

        if (is_scalar($_POST[$key])) {
            return (string) (new Sanitize($_POST[$key]))->data();
        }

        if (is_array($_POST[$key])) {
            return (string) json_encode(
                $this->buildNewArray($key, $_POST)
            );
        }

        return (string) $_POST[$key];
    }

    /**
     * Get a get item.
     *
     * @param string $key the key to search for the corresponding value in the get array
     *
     * @return string
     */
    public function get(string $key)
    {
        if (!isset($_GET[$key])) {
            return '';
        }

        if (is_scalar($_GET[$key])) {
            return (string) (new Sanitize($_GET[$key]))->data();
        }

        if (is_array($_GET[$key])) {
            return (string) json_encode(
                $this->buildNewArray($key, $_GET)
            );
        }

        return (string) $_GET[$key];
    }

    /**
     * Get a uploaded file.
     *
     * @param string $key the key to search for the corresponding value in the file array
     *
     * @return array
     */
    public function file(string $key)
    {
        return isset($_FILES[$key]) ? $_FILES[$key] : [];
    }

    /**
     * Get all post items which are matching with the given parameters.
     *
     * @param array $parameters the parameters to loop through and search for the corresponding values
     *
     * @return array
     */
    public function posts(array $parameters)
    {
        $posts = [];
        foreach ($parameters as $parameter) {
            $posts += [$parameter => $this->post($parameter)];
        }

        return $posts;
    }

    /**
     * Build a new array with sanitized values.
     *
     * @param string $key    the key to search for the corresponding value in the array
     * @param array  $method the array to search for the corresponding value
     *
     * @return array
     */
    private function buildNewArray(string $key, array $method)
    {
        $newArray = [];
        foreach ($method[$key] as $data) {
            if (is_scalar($data)) {
                $newArray[] = (new Sanitize($data))->data();
            }
        }

        return $newArray;
    }
}
