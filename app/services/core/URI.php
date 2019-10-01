<?php
declare(strict_types=1);


namespace App\services\core;

class URI
{
    /**
     * Get the url.
     *
     * @return string
     */
    public static function getUrl(): string
    {
        $sanitize = new Sanitize($_SERVER['REQUEST_URI'], 'url');

        return (string) $sanitize->data();
    }

    /**
     * Get the previous url.
     *
     * @return string
     */
    public static function getPreviousUrl(): string
    {
        $sanitize = new Sanitize($_SERVER['HTTP_REFERER'], 'url');

        return (string) $sanitize->data();
    }

    /**
     * Get the domain extension.
     *
     * @return string
     */
    public static function getDomainExtension(): string
    {
        $host = $_SERVER['HTTP_HOST'] ?? '';
        $hostExploded = explode('.', $host);
        $arrayKeyLast = array_key_last($hostExploded);

        return $hostExploded[$arrayKeyLast] ?? 'nl';
    }

    /**
     * Get the host of the app.
     *
     * @return string
     */
    public static function getHost(): string
    {
        return $_SERVER['HTTP_HOST'] ?? '';
    }

    /**
     * Get the remote ip of the app.
     *
     * @return string
     */
    public static function getRemoteIp(): string
    {
        return $_SERVER['REMOTE_ADDR'] ?? '';
    }

    /**
     * Get the user agent.
     *
     * @return string
     */
    public static function getUserAgent(): string
    {
        return $_SERVER['HTTP_USER_AGENT'] ?? '';
    }

    /**
     * Redirect to a specific url.
     *
     * @param string $url the url to redirect
     */
    public static function redirect(string $url): void
    {
        header('Location: '.$url);
    }

    /**
     * Refresh the page.
     *
     * @param string $url         the url to refresh
     * @param int    $refreshTime the refresh time
     */
    public static function refresh(string $url, int $refreshTime): void
    {
        $sanitize = new Sanitize($url, 'url');

        header("Refresh: {$refreshTime}; URL=/".$sanitize->data());
    }

    /**
     * Get the request method.
     *
     * @return string
     */
    public static function method(): string
    {
        return $_SERVER['REQUEST_METHOD'] ?? '';
    }
}
