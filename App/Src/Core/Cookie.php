<?php

declare(strict_types=1);

namespace App\Src\Core;

use App\Src\Security\Encrypt;
use Exception;

final class Cookie
{
    /**
     * The expiring time of the cookie.
     *
     * @var int
     */
    private $expiringTime;

    /**
     * The path of the cookie.
     *
     * @var string
     */
    private $path;

    /**
     * The domain of the cookie.
     *
     * @var string
     */
    private $domain;

    /**
     * Determine if the cookie must be secure.
     *
     * @var bool
     */
    private $secure;

    /**
     * Determine if the cookie must be http only.
     *
     * @var bool
     */
    private $httpOnly;

    /**
     * Construct the cookie.
     *
     * @param int    $expiringTime The expiring time of the cookie
     * @param string $path         The path of the cookie
     * @param string $domain       The domain of the cookie
     * @param bool   $secure       Determine if the cookie must be secure
     * @param bool   $httpOnly     Determine if the cookie must be http only
     */
    public function __construct(
        int $expiringTime = 1 * 24 * 60 * 60,
        string $path = '/',
        string $domain = '',
        bool $secure = false,
        bool $httpOnly = true
    ) {
        $this->expiringTime = $expiringTime;
        $this->path = $path;
        $this->domain = $domain;
        $this->secure = $secure;
        $this->httpOnly = $httpOnly;
    }

    /**
     * Save data in the cookie.
     *
     * @param string $key   the key of the cookie item
     * @param string $value the value of the key
     *
     * @throws Exception
     */
    public function save(string $key, string $value): void
    {
        if (array_key_exists($key, $_COOKIE)) {
            return;
        }

        $sanitize = new Sanitize($value);
        $data = new Encrypt((string) $sanitize->data());

        setcookie(
            $key,
            $data->encrypt(),
            time() + $this->expiringTime,
            $this->path,
            $this->domain,
            $this->secure,
            $this->httpOnly
        );
    }

    /**
     * Get data from the cookie; unset it if specified.
     *
     * @param string $key   the key for searching to the
     *                      corresponding cookie value
     *
     * @return string
     *
     * @throws Exception
     */
    public function get(string $key): string
    {
        $request = new Request();

        if ($request->cookie($key) === '') {
            return '';
        }

        $sanitize = new Sanitize($request->cookie($key));
        $data = new Encrypt((string) $sanitize->data());

        return $data->decrypt();
    }

    /**
     * Unset the cookie.
     *
     * @param string $key
     */
    public function unset(string $key): void
    {
        if (!array_key_exists($key, $_COOKIE)) {
            return;
        }

        setcookie(
            $key,
            '',
            time() - $this->expiringTime,
            $this->path,
            $this->domain,
            $this->secure,
            $this->httpOnly
        );
    }
}
