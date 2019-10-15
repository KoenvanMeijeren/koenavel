<?php
declare(strict_types=1);


namespace App\Services\Core;

final class Request
{
    /**
     * Get a post item.
     *
     * @param string $key the key to search for the corresponding value in the post array
     *
     * @return string
     */
    public function post(string $key): string
    {
        if (!isset($_POST[$key])) {
            return '';
        }

        if (is_array($_POST[$key])) {
            return (string) json_encode(
                $this->buildNewArray($key, $_POST), JSON_THROW_ON_ERROR
            );
        }

        return (string) (new Sanitize($_POST[$key]))->data();
    }

    /**
     * Get a get item.
     *
     * @param string $key the key to search for the corresponding value in the get array
     *
     * @return string
     */
    public function get(string $key): string
    {
        if (!isset($_GET[$key])) {
            return '';
        }

        if (is_array($_GET[$key])) {
            return (string) json_encode($this->buildNewArray($key, $_GET), JSON_THROW_ON_ERROR);
        }

        return (string) (new Sanitize($_GET[$key]))->data();
    }

    /**
     * Get a uploaded file.
     *
     * @param string $key the key to search for the
     *                    corresponding value in
     *                    the file array
     *
     * @return string[]
     */
    public function file(string $key): array
    {
        return isset($_FILES[$key]) ? $_FILES[$key] : [];
    }

    /**
     * Get all post items which are matching with the given parameters.
     *
     * @param string[] $parameters the parameters to loop
     *                             through and search for
     *                             the corresponding
     *                             values
     *
     * @return string[]
     */
    public function posts(array $parameters): array
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
     * @param string  $key    the key to search for the
     *                        corresponding value in
     *                        the array

     * @param array[] $method the array to search for the
     *                        corresponding value
     *
     * @return string[]|int[]|bool[]|float[]
     */
    private function buildNewArray(string $key, array $method): array
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
