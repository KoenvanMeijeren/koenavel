<?php
declare(strict_types=1);


namespace App\Services\Core;

final class Request
{
    /**
     * A few server item options
     *
     * @var string
     */
    const URI = 'REQUEST_URI';//used URI for page access
    const METHOD = 'REQUEST_METHOD';//used method for page access
    const HTTP_HOST = 'HTTP_HOST';// host header from current request
    const HTTP_REFERER = 'HTTP_REFERER';// complete URL of current page
    const HTTP_USER_AGENT = 'HTTP_USER_AGENT';// the agent of the user
    const USER_IP_ADDRESS = 'REMOTE_ADDR';// IP address from the user his IP
    const DOCUMENT_ROOT = 'DOCUMENT_ROOT';// the root of the document

    /**
     * Get a server item.
     *
     * @param string $key the key to search for the corresponding
     *                    value in the server array
     *
     * @return string
     */
    public function server(string $key): string
    {
        return $this->request($_SERVER, $key);
    }

    /**
     * Get a post item.
     *
     * @param string $key the key to search for the corresponding
 *                        value in the post array
     *
     * @return string
     */
    public function post(string $key): string
    {
        return $this->request($_POST, $key);
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
        return $this->request($_GET, $key);
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
     * Get an env item.
     *
     * @param string $key the key to search for the corresponding
     *                        value in the env array
     *
     * @return string
     */
    public function env(string $key): string
    {
        return $this->request($_ENV, $key);
    }

    /**
     * Get a cookie item.
     *
     * @param string $key the key to search for the corresponding
     *                        value in the cookie array
     *
     * @return string
     */
    public function cookie(string $key): string
    {
        return $this->request($_COOKIE, $key);
    }

    /**
     * Get a session item.
     *
     * @param string $key the key to search for the corresponding
     *                        value in the session array
     *
     * @return string
     */
    public function session(string $key): string
    {
        return $this->request($_SESSION, $key);
    }

    /**
     * Request data from the super globals.
     *
     * @param array[]  $superGlobal get the data from the super global
     * @param string   $key         the key to search for the corresponding
     *                              value in the super global
     *
     * @return string the data from the super global
     */
    private function request(array $superGlobal, string $key): string {
        if (!isset($superGlobal[$key])) {
            return '';
        }

        $variable = $superGlobal[$key];
        if (is_array($variable)) {
            return (string) json_encode(
                $this->buildNewArray($superGlobal, $key),
                JSON_THROW_ON_ERROR
            );
        }

        return (string)(new Sanitize($variable))->data();
    }

    /**
     * Build a new array with sanitized values.
     *
     * @param array[]  $superGlobal get the data from the super global
     * @param string   $key         the key to search for the corresponding
     *                            value in the super global
     *
     * @return string[]|int[]|bool[]|float[]
     */
    private function buildNewArray(array $superGlobal, string $key): array
    {
        $newArray = [];
        foreach ($superGlobal[$key] as $data) {
            if (is_scalar($data)) {
                $newArray[] = (new Sanitize($data))->data();
            }

            $newArray[] = $data;
        }

        return $newArray;
    }
}
