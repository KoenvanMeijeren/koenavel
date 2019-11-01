<?php
declare(strict_types=1);


namespace App\Src\Session;

use App\Src\Core\Request;
use App\Src\Core\Sanitize;
use App\Src\Core\URI;
use App\Src\Log\Log;
use App\Src\Security\Encrypt;
use Exception;

final class Session
{
    /**
     * Save data in the session.
     *
     * @param string $key   the key of the session item
     * @param string $value the value of the key
     *
     * @throws Exception
     */
    public function save(string $key, string $value): void
    {
        if (isset($_SESSION[$key])) {
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
     *
     * @throws Exception
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
     *
     * @throws Exception
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
     *
     * @throws Exception
     */
    public function get(string $key, bool $unset = false): string
    {
        $request = new Request();
        $sanitize = new Sanitize($request->session($key));

        if (empty($sanitize->data())) {
            return '';
        }

        $data = new Encrypt((string)$sanitize->data());
        $value = $data->decrypt();

        if ($unset) {
            $this->unset($key);
        }

        $this->logRequest($key, $value);
        return $value;
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
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }

        return true;
    }

    /**
     * Log the session request.
     *
     * @param string $key
     * @param string $value
     *
     * @throws Exception
     */
    private function logRequest(string $key, string $value): void
    {
        $log = new Log();

        if ($key === 'error' || $key === 'success') {
            $log->addAppRequest(
                $value,
                $key === 'success' ? 'Successful' : 'Failed',
                URI::getUrl(),
                URI::getMethod()
            );
        }
    }
}
