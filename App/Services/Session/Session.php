<?php
declare(strict_types=1);


namespace App\Services\Session;

use App\Services\Core\Log;
use App\Services\Core\Request;
use App\Services\Core\Sanitize;
use App\Services\Core\URI;
use App\Services\Security\Encrypt;
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
     * Force to save data in the session.
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
     * TODO: flash data automatically into the session.
     * TODO: If you do this then the name makes sense
     * TODO: otherwise you can better remove the function
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
        $log = new Log();
        $uri = new URI();
        $sanitize = new Sanitize($request->session($key));
        $data = new Encrypt((string)$sanitize->data());
        $value = $data->decrypt();

        if ($unset) {
            $this->unset($key);
        }

        if ($key === 'error' || $key === 'success') {
            $log->appRequest($value,
                $key === 'success' ? 'Successful' : 'Failed',
                $uri->getUrl(), $uri->getMethod()
            );
        }

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

            return true;
        }

        return false;
    }
}
