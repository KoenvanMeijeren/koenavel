<?php
declare(strict_types=1);


namespace App\services\session;

use App\services\core\Log;
use App\services\core\Sanitize;
use App\services\core\URI;
use App\services\security\Encrypt;
use Exception;

final class Session
{
    /**
     * Construct the session.
     *
     * @param int $expiringTime the expiring time of the session
     *
     * @throws Exception
     */
    public function __construct(int $expiringTime = 1 * 1 * 60 * 60)
    {
        new Builder('websiteID', $expiringTime);
    }

    /**
     * Save data in the session.
     *
     * @param string $key the key of the session item
     * @param string $value the value of the key
     *
     * @throws Exception
     */
    public static function save(string $key, string $value): void
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
     * @param string $key the key of the session item
     * @param string $value the value of the key
     *
     * @throws Exception
     */
    public static function saveForced(string $key, string $value): void
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
     * @param string $key the key of the session item
     * @param string $value the value of the key
     *
     * @throws Exception
     */
    public static function flash(string $key, string $value): void
    {
        self::saveForced($key, $value);
    }

    /**
     * Get data from the session; unset the data if specified.
     *
     * @param string $key the key for searching to the
     *                      corresponding session value
     * @param bool $unset Must the session value be destroyed?
     *
     * @return string
     *
     * @throws Exception
     */
    public static function get(string $key, bool $unset = false): string
    {
        if (isset($_SESSION[$key])) {
            $sanitize = new Sanitize($_SESSION[$key]);
            $data = new Encrypt((string)$sanitize->data());
            $value = $data->decrypt();

            if ($unset) {
                self::unset($key);
            }

            self::logRequest($key, $value);
        }

        return $value ?? '';
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
    public static function unset(string $key): bool
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }

        return true;
    }

    /**
     * Destroy the session.
     *
     * @throws Exception
     */
    public static function destroy(): void
    {
        Log::info('The session is destroyed.');
        $params = session_get_cookie_params();
        setcookie(
            session_name(),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );

        session_unset();
        session_destroy();

        new Session();
    }

    /**
     * Log the session request.
     *
     * @param string $key the key to search for
     *                      the corresponding
     *                      value
     * @param string $value the value of the key
     *
     * @throws Exception
     */
    private static function logRequest(string $key, string $value): void
    {
        $message = URI::method();
        $message .= ' request for page ';
        $message .= URI::getUrl();
        $message .= ' with message "';
        $message .= $value;
        $message .= '"';

        if ('error' === $key) {
            Log::info("Failed {$message}");
        } elseif ('success' === $key) {
            Log::info("Successful {$message}");
        }

        Log::info($message);
    }
}
