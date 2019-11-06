<?php
declare(strict_types=1);


namespace App\Src\Session;

use App\Src\Core\Request;
use App\Src\Core\Sanitize;
use App\Src\Core\URI;
use App\Src\Log\Log;
use App\Src\Security\Encrypt;
use App\Src\State\State;

final class Session
{
    /**
     * Save data in the session.
     *
     * @param string $key   the key of the session item
     * @param string $value the value of the key
     */
    public function save(string $key, string $value): void
    {
        if (array_key_exists($key, $_SESSION)) {
            return;
        }

        $sanitize = new Sanitize($value);
        $data = new Encrypt((string)$sanitize->data());
        $_SESSION[$key] = $data->encrypt();
    }

    /**
     * Forced save of data in the session.
     *
     * @param string $key   the key of the session item
     * @param string $value the value of the key
     */
    public function saveForced(string $key, string $value): void
    {
        $sanitize = new Sanitize($value);
        $data = new Encrypt((string)$sanitize->data());
        $_SESSION[$key] = $data->encrypt();
    }

    /**
     * Flash data in the session.
     *
     * @param string $key   the key of the session item
     * @param string $value the value of the key
     */
    public function flash(string $key, string $value): void
    {
        $this->saveForced($key, $value);
    }

    /**
     * Get data from the session; unset the data if specified.
     *
     * @param string $key   the key for searching to the
     *                      corresponding session value

     * @param bool   $unset Must the session value be destroyed?
     *
     * @return string
     */
    public function get(string $key, bool $unset = false): string
    {
        $request = new Request();
        $sanitize = new Sanitize($request->session($key));
        $data = (string) $sanitize->data();

        if ($data === '') {
            return '';
        }

        $data = new Encrypt($data);
        $value = $data->decrypt();

        if ($unset) {
            $this->unset($key);
        }

        $this->logRequest($key, $value);
        return $value;
    }

    /**
     * Check if the given key exists in the super global array.
     *
     * @param string $key the key to be checked for if it exists.
     *
     * @return bool
     */
    public function exists(string $key): bool
    {
        if (array_key_exists($key, $_SESSION)) {
            return true;
        }

        return false;
    }

    /**
     * Unset data from the session.
     *
     * @param string $key the key for searching to the
     *                    corresponding session value
     *                    to unset it
     *
     * @return bool
     */
    public function unset(string $key): bool
    {
        if (array_key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        }

        return true;
    }

    /**
     * Log the session request.
     *
     * @param string $key
     * @param string $value
     */
    private function logRequest(string $key, string $value): void
    {
        if ($key === State::FAILED || $key === State::SUCCESSFUL) {
            Log::appRequest(
                $value,
                $key === State::SUCCESSFUL ?
                    State::SUCCESSFUL : State::FAILED,
                URI::getUrl(),
                URI::getMethod()
            );
        }
    }
}
